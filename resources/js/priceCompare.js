let selectedId = null;
let debounceTimer = null;

// ---------- Helpers ----------

function formatRupiah(amount) {
  return "Rp " + amount.toLocaleString("id-ID");
}

function getStoreIcon(storeName) {
  // Default fallback icons jika tidak ada di database
  const name = storeName.toLowerCase();
  if (name.includes("g2a")) {
    return '<svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#e0472b"/><path d="M8 12l2.5 2.5L16 9" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  }
  if (name.includes("steam")) {
    return '<svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#1b2838"/><circle cx="12" cy="12" r="4" fill="#c7d5e0"/><circle cx="12" cy="12" r="2" fill="#1b2838"/></svg>';
  }
  if (name.includes("gog")) {
    return '<svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#86328a"/><text x="5" y="16" font-size="7" fill="white" font-weight="bold">GOG</text></svg>';
  }
  if (name.includes("epic")) {
    return '<svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#313131"/><text x="6.5" y="16" font-size="8" fill="white" font-weight="bold">EG</text></svg>';
  }
  if (name.includes("rockstar")) {
    return '<svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#fcaf17"/><text x="6" y="16" font-size="7" fill="#000" font-weight="bold">R★</text></svg>';
  }
  return '<svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#4a5568"/></svg>';
}

function calculateDiscount(originalPrice, currentPrice) {
  if (!originalPrice || originalPrice <= currentPrice) return null;
  return Math.round(((originalPrice - currentPrice) / originalPrice) * 100);
}

// ---------- Data (langsung dari db.js, tanpa fetch) ----------

function getGames(search) {
  var q = (search || "").trim().toLowerCase();
  var dbGames = window.games || [];
  return dbGames
    .filter(function (g) { return g.title.toLowerCase().includes(q); })
    .map(function (g) {
      return {
        id:          g.id,
        title:       g.title,
        thumbnail:   g.thumbnail,
        lowestPrice: Math.min.apply(null, g.stores.map(function (s) { return s.price; }))
      };
    })
    .sort(function (a, b) {
      return a.title.localeCompare(b.title);
    });
}

function getStoresForGame(gameId) {
  var dbGames = window.games || [];
  var game = dbGames.find(function (g) { return g.id === gameId; });
  if (!game) return null;
  return { id: game.id, title: game.title, stores: game.stores };
}

// ---------- Render: Search Results ----------

function renderResults(search) {
  var list = document.getElementById("resultsList");
  var gameList = getGames(search);
  
  // Update label based on search state
  var label = document.querySelector(".results-panel span");
  if (label) {
    label.textContent = search.trim() ? "SEARCH RESULT" : "GAME LIST";
  }

  list.innerHTML = "";

  if (gameList.length === 0) {
    list.innerHTML = '<p class="text-[#808080] text-sm p-2">No games found.</p>';
    return;
  }

  // Don't auto-select on initial load (when search is empty)
  if (search.trim() && (!selectedId || !gameList.find(function (g) { return g.id === selectedId; }))) {
    selectedId = gameList[0].id;
    renderStore(selectedId);
  } else if (!search.trim() && !selectedId) {
    // Clear store panel when no search and no selection
    renderStore(null);
  }

  gameList.forEach(function (game) {
    var card = document.createElement("div");
    card.className = "flex items-center gap-3.5 bg-[#1E1E1E] border border-[#2a2a2a] rounded-xl p-3 cursor-pointer transition-all hover:border-[#33385a] flex-shrink-0 relative z-[1]" + 
      (game.id === selectedId ? " !border-[#FF6B35] shadow-[0_0_0_1px_rgba(255,107,53,0.25),inset_0_0_20px_rgba(255,107,53,0.08)]" : "");
    card.dataset.id = game.id;
    
    card.innerHTML =
      '<img class="w-14 h-14 rounded-lg object-cover flex-shrink-0 bg-[#232645]" src="' + game.thumbnail + '" alt="' + game.title + '">' +
      '<div class="flex flex-col gap-1 min-w-0">' +
        '<span class="text-sm font-semibold text-[#F4F4F4] whitespace-nowrap overflow-hidden text-ellipsis">' + game.title + '</span>' +
        '<span class="text-xs text-[#C0C0C0]">Lowest Price : <span class="text-[#FF9F1C] font-semibold">' + formatRupiah(game.lowestPrice) + '</span></span>' +
      '</div>';

    card.addEventListener("click", function () {
      selectedId = game.id;
      var cards = list.querySelectorAll("[data-id]");
      cards.forEach(function (c) {
        if (c.dataset.id === selectedId) {
          c.className = "flex items-center gap-3.5 bg-[#1E1E1E] border border-[#2a2a2a] rounded-xl p-3 cursor-pointer transition-all hover:border-[#33385a] flex-shrink-0 relative z-[1] !border-[#FF6B35] shadow-[0_0_0_1px_rgba(255,107,53,0.25),inset_0_0_20px_rgba(255,107,53,0.08)]";
        } else {
          c.className = "flex items-center gap-3.5 bg-[#1E1E1E] border border-[#2a2a2a] rounded-xl p-3 cursor-pointer transition-all hover:border-[#33385a] flex-shrink-0 relative z-[1]";
        }
      });
      renderStore(game.id);
      
      // Auto-switch to store tab on mobile after selecting a game
      switchToStoreTabOnMobile();
    });

    list.appendChild(card);
  });
}

// ---------- Render: Store Panel ----------

function renderStore(gameId) {
  var titleEl   = document.getElementById("storeGameTitle");
  var storeList = document.getElementById("storeList");

  var data = getStoresForGame(gameId);
  if (!data) {
    titleEl.textContent  = "—";
    storeList.innerHTML  = '<li class="text-[#808080] text-sm py-2 text-center">Select a game to compare prices across stores.</li>';
    return;
  }

  titleEl.textContent = data.title;
  storeList.innerHTML = "";

  var minPrice = Math.min.apply(null, data.stores.map(function (s) { return s.price; }));

  data.stores.forEach(function (store) {
    var isLowest = store.price === minPrice;
    
    // Gunakan icon dari database, atau fallback ke getStoreIcon
    var icon = store.icon || getStoreIcon(store.store);
    
    // Hitung diskon persentase secara otomatis dari originalPrice dan price
    var discountPercent = calculateDiscount(store.originalPrice, store.price);

    var priceHTML = "";
    if (store.originalPrice && discountPercent) {
      priceHTML =
        '<div class="ml-auto flex flex-col items-end gap-1 flex-shrink-0">' +
          '<div class="flex items-center gap-2">' +
            '<span class="text-[11px] text-[#808080] line-through">' + formatRupiah(store.originalPrice) + '</span>' +
            '<span class="text-[10px] font-bold text-[#ffb4b4] bg-[#ff4757] px-1.5 py-0.5 rounded">-' + discountPercent + '%</span>' +
          '</div>' +
          '<span class="text-sm font-semibold ' + (isLowest ? 'text-[#FF9F1C]' : 'text-[#C0C0C0]') + '">' + formatRupiah(store.price) + '</span>' +
        '</div>';
    } else {
      priceHTML =
        '<div class="ml-auto flex flex-col items-end gap-1 flex-shrink-0">' +
          '<span class="text-sm font-semibold ' + (isLowest ? 'text-[#FF9F1C]' : 'text-[#C0C0C0]') + '">' + formatRupiah(store.price) + '</span>' +
        '</div>';
    }

    var row = document.createElement("li");
    row.className = "flex items-center gap-4 py-3.5 border-b border-[#2a2a2a] last:border-b-0 last:pb-0.5";
    row.innerHTML =
      '<span class="flex items-center gap-2.5 text-sm font-semibold text-[#F4F4F4] min-w-[120px] flex-shrink-0">' + icon + store.store + '</span>' +
      priceHTML +
      '<a href="' + store.url + '" target="_blank" rel="noopener" class="text-xs font-bold tracking-wide no-underline whitespace-nowrap flex-shrink-0 ml-4 bg-gradient-to-r from-[#e85a28] to-[#FF6B35] text-white px-4 py-2 rounded-full transition-all hover:brightness-110">GO TO STORE</a>';

    storeList.appendChild(row);
  });
}

// ---------- Search (debounced) ----------

document.getElementById("searchInput").addEventListener("input", function () {
  var value = this.value;
  clearTimeout(debounceTimer);
  debounceTimer = setTimeout(function () {
    renderResults(value);
  }, 250);
});

// Auto-switch to Games tab on mobile when search is focused
document.getElementById("searchInput").addEventListener("focus", function () {
  switchToGamesTabOnMobile();
});

function switchToGamesTabOnMobile() {
  var tabBtns = document.querySelectorAll(".tab-btn");
  var resultsBtn = document.querySelector('.tab-btn[data-tab="results"]');
  var resultsPanel = document.getElementById("resultsPanel");
  var storePanel = document.getElementById("storePanel");
  
  // Check if mobile tabs are visible
  var mobileTabs = document.querySelector(".mobile-tabs");
  if (!mobileTabs) return;
  
  var isVisible = window.getComputedStyle(mobileTabs).display !== "none";
  if (!isVisible) return;
  
  // Switch to games/results tab
  tabBtns.forEach(function (b) { b.classList.remove("active"); });
  if (resultsBtn) resultsBtn.classList.add("active");
  
  resultsPanel.classList.add("active");
  storePanel.classList.remove("active");
}

// ---------- Mobile Tab Switching ----------

function switchToStoreTabOnMobile() {
  // Only auto-switch on mobile (when tabs are visible)
  var tabBtns = document.querySelectorAll(".tab-btn");
  var storeBtn = document.querySelector('.tab-btn[data-tab="store"]');
  var resultsPanel = document.getElementById("resultsPanel");
  var storePanel = document.getElementById("storePanel");
  
  // Check if mobile tabs are visible (display: flex)
  var mobileTabs = document.querySelector(".mobile-tabs");
  if (!mobileTabs) return;
  
  var isVisible = window.getComputedStyle(mobileTabs).display !== "none";
  if (!isVisible) return;
  
  // Switch to store tab
  tabBtns.forEach(function (b) { b.classList.remove("active"); });
  if (storeBtn) storeBtn.classList.add("active");
  
  resultsPanel.classList.remove("active");
  storePanel.classList.add("active");
}

function initMobileTabs() {
  var tabBtns = document.querySelectorAll(".tab-btn");
  var resultsPanel = document.getElementById("resultsPanel");
  var storePanel = document.getElementById("storePanel");

  if (!tabBtns.length || !resultsPanel || !storePanel) return;

  // Set default active panel (results)
  resultsPanel.classList.add("active");

  tabBtns.forEach(function (btn) {
    btn.addEventListener("click", function () {
      var targetTab = this.dataset.tab;

      // Update button states
      tabBtns.forEach(function (b) { b.classList.remove("active"); });
      this.classList.add("active");

      // Update panel visibility
      if (targetTab === "results") {
        resultsPanel.classList.add("active");
        storePanel.classList.remove("active");
      } else if (targetTab === "store") {
        resultsPanel.classList.remove("active");
        storePanel.classList.add("active");
      }
    });
  });
}

// ---------- Init ----------

renderResults("");
initMobileTabs();
