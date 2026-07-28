// ============================================================
//  LOGIC  –  Game Price Compare
//  Data dibaca langsung dari db.js (variabel global `games`).
//  Tidak memerlukan server – bisa berjalan langsung di browser.
//  Nanti di Laravel, ganti sumber data dengan API Laravel.
// ============================================================

let selectedId = null;
let debounceTimer = null;

// ---------- Helpers ----------

function formatRupiah(amount) {
  return "Rp " + amount.toLocaleString("id-ID");
}

function getStoreIcon(storeName) {
  const name = storeName.toLowerCase();
  if (name.includes("g2a")) {
    return '<svg class="store-icon" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#e0472b"/><path d="M8 12l2.5 2.5L16 9" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>';
  }
  if (name.includes("steam")) {
    return '<svg class="store-icon" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#1b2838"/><circle cx="12" cy="12" r="4" fill="#c7d5e0"/><circle cx="12" cy="12" r="2" fill="#1b2838"/></svg>';
  }
  if (name.includes("gog")) {
    return '<svg class="store-icon" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#86328a"/><text x="6" y="16" font-size="7" fill="white" font-weight="bold">GOG</text></svg>';
  }
  return "";
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

  list.innerHTML = "";

  if (gameList.length === 0) {
    list.innerHTML = '<p style="color:var(--text-muted);font-size:13px;padding:8px 4px;">No games found.</p>';
    return;
  }

  // Auto-select game pertama kalau belum ada yang dipilih
  if (!selectedId || !gameList.find(function (g) { return g.id === selectedId; })) {
    selectedId = gameList[0].id;
    renderStore(selectedId);
  }

  gameList.forEach(function (game) {
    var card = document.createElement("div");
    card.className = "result-card" + (game.id === selectedId ? " selected" : "");
    card.dataset.id = game.id;
    card.innerHTML =
      '<img class="result-thumb" src="' + game.thumbnail + '" alt="' + game.title + '">' +
      '<div class="result-info">' +
        '<span class="result-title">' + game.title + '</span>' +
        '<span class="result-price">Lowest Price : <span>' + formatRupiah(game.lowestPrice) + '</span></span>' +
      '</div>';

    card.addEventListener("click", function () {
      selectedId = game.id;
      var cards = list.querySelectorAll(".result-card");
      cards.forEach(function (c) {
        c.classList.toggle("selected", c.dataset.id === selectedId);
      });
      renderStore(game.id);
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
    storeList.innerHTML  = '<li style="color:var(--text-muted);font-size:13px;padding:8px 0;">Store data unavailable.</li>';
    return;
  }

  titleEl.textContent = data.title;
  storeList.innerHTML = "";

  var minPrice = Math.min.apply(null, data.stores.map(function (s) { return s.price; }));

  data.stores.forEach(function (store) {
    var isLowest = store.price === minPrice;
    var icon     = getStoreIcon(store.store);

    var priceHTML = "";
    if (store.originalPrice && store.discountPercent) {
      priceHTML =
        '<div class="store-price-container">' +
          '<div class="store-price-row">' +
            '<span class="store-original-price">' + formatRupiah(store.originalPrice) + '</span>' +
            '<span class="store-discount">-' + store.discountPercent + '%</span>' +
          '</div>' +
          '<span class="store-price' + (isLowest ? ' lowest' : '') + '">' + formatRupiah(store.price) + '</span>' +
        '</div>';
    } else {
      priceHTML =
        '<div class="store-price-container">' +
          '<span class="store-price' + (isLowest ? ' lowest' : '') + '">' + formatRupiah(store.price) + '</span>' +
        '</div>';
    }

    var row = document.createElement("li");
    row.className = "store-row";
    row.innerHTML =
      '<span class="store-name">' + icon + store.store + '</span>' +
      priceHTML +
      '<a href="' + store.url + '" target="_blank" rel="noopener" class="store-action button">GO TO STORE</a>';

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

// ---------- Init ----------

renderResults("");