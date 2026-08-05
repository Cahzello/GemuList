const App = {
  games: [],

  currentFilter: "all",
  sortState: { type: "recent", dir: "asc" },
  selectedGameId: null,
  searchQuery: "",
  currentPage: 1,
  rowsPerPage: 3,

  init() {
    if (window.personalScoreGames && window.personalScoreGames.length) {
      this.games = window.personalScoreGames;
    }
    this.renderCards();
    this.initSortBar();
    this.initSearch();
    this.initModal();
    window.addEventListener("resize", () => this.renderCards());
  },

  getFilteredGames() {
    let list = [...this.games];
    if (this.currentFilter === "finished") {
      list = list.filter(g => g.status === "finished");
    } else if (this.currentFilter === "dropped") {
      list = list.filter(g => g.status === "dropped");
    } else if (this.currentFilter === "unrated") {
      list = list.filter(g => !g.hasScore);
    }
    if (this.searchQuery.trim()) {
      const q = this.searchQuery.trim().toLowerCase();
      list = list.filter(g => g.title.toLowerCase().startsWith(q));
      return list;
    }
    this.applySort(list);
    return list;
  },

  applySort(list) {
    if (!this.sortState) return;
    const { type, dir } = this.sortState;
    const mult = dir === "desc" ? -1 : 1;
    if (type === "rating") {
      list.sort((a, b) => mult * ((b.score || 0) - (a.score || 0)));
    } else if (type === "title") {
      list.sort((a, b) => mult * a.title.localeCompare(b.title));
    } else if (type === "recent") {
      if (dir === "desc") list.reverse();
    }
  },

  setFilter(filter) {
    this.currentFilter = filter;
    this.currentPage = 1;
    this.updateSortBarUI();
    this.renderCards();
  },

  cycleSort(type) {
    if (this.sortState.type !== type) {
      this.sortState = { type, dir: "asc" };
    } else {
      this.sortState = { type, dir: this.sortState.dir === "asc" ? "desc" : "asc" };
    }
    this.currentPage = 1;
    this.updateSortBarUI();
    this.renderCards();
  },

  initSortBar() {
    document.querySelectorAll(".sort-bar-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        if (btn.classList.contains("sort-bar-btn1")) this.setFilter("all");
        else if (btn.classList.contains("sort-bar-btn-finished")) this.setFilter("finished");
        else if (btn.classList.contains("sort-bar-btn-dropped")) this.setFilter("dropped");
        else if (btn.classList.contains("sort-bar-btn-unrated")) this.setFilter("unrated");
      });
    });
    const sortRow = document.querySelector(".sort-bar-row-right");
    if (sortRow) {
      sortRow.addEventListener("click", (e) => {
        const option = e.target.closest(".sort-option");
        if (!option) return;
        const type = option.dataset.sort;
        if (type) this.cycleSort(type);
      });
    }
    this.updateSortBarUI();
  },

  updateSortBarUI() {
    document.querySelectorAll(".sort-bar-btn").forEach(btn => {
      btn.classList.remove("bg-[#FF6B35]");
    });
    const activeBtn = document.querySelector(
      this.currentFilter === "all" ? ".sort-bar-btn1" :
      this.currentFilter === "finished" ? ".sort-bar-btn-finished" :
      this.currentFilter === "unrated" ? ".sort-bar-btn-unrated" :
      ".sort-bar-btn-dropped"
    );
    if (activeBtn) activeBtn.classList.add("bg-[#FF6B35]");

    document.querySelectorAll(".sort-option").forEach(el => {
      el.classList.remove("active-desc", "active-asc", "bg-[#FF6B35]");
      const arrow = el.querySelector(".sort-arrow");
      if (arrow) {
        arrow.classList.remove("text-[#F4F4F4]");
        arrow.textContent = "\u2193";
      }
    });

    const active = document.querySelector(".sort-option[data-sort=\"" + this.sortState.type + "\"]");
    if (active) {
      active.classList.add(this.sortState.dir === "desc" ? "active-desc" : "active-asc", "bg-[#FF6B35]");
      const arrow = active.querySelector(".sort-arrow");
      if (arrow) {
        arrow.classList.add("text-[#F4F4F4]");
        arrow.textContent = this.sortState.dir === "asc" ? "\u2193" : "\u2191";
      }
    }
  },

  renderCards() {
    const container = document.querySelector(".cards");
    if (!container) return;
    const games = this.getFilteredGames();
    const pageSize = this.getPageSize();
    const totalPages = Math.max(1, Math.ceil(games.length / pageSize));
    if (this.currentPage > totalPages) this.currentPage = totalPages;
    if (this.currentPage < 1) this.currentPage = 1;

    container.innerHTML = "";
    if (games.length === 0) {
      container.innerHTML = '<p class="text-[rgba(244,244,244,0.72)] text-[18px] py-10">No games match this filter.</p>';
      return;
    }

    const start = (this.currentPage - 1) * pageSize;
    const pageGames = games.slice(start, start + pageSize);

    const grid = document.createElement("div");
    grid.className = "grid grid-cols-2 gap-x-[21px] gap-y-[25px] w-full auto-rows-[1fr] items-stretch min-[901px]:auto-rows-[264px] max-[900px]:grid-cols-1";
    pageGames.forEach(game => {
      grid.appendChild(this.createCard(game));
    });
    container.appendChild(grid);

    if (totalPages > 1) {
      container.appendChild(this.renderPagination(totalPages));
      this.bindPagination();
    }
  },

  getGridColumns() {
    return window.matchMedia("(min-width: 901px)").matches ? 2 : 1;
  },

  getPageSize() {
    return this.getGridColumns() * this.rowsPerPage;
  },

  getPageButtons(current, total) {
    const windowSize = 5;
    if (total <= windowSize + 1) {
      return Array.from({ length: total }, (_, i) => i + 1);
    }
    let start = Math.min(Math.max(current - (windowSize - 1), 1), total - windowSize + 1);
    let end = start + windowSize - 1;
    if (end >= total - 1) {
      start = total - windowSize + 1;
      end = total;
    }
    const result = [];
    for (let p = start; p <= end; p++) result.push(p);
    if (end < total) {
      result.push("...");
      result.push(total);
    }
    return result;
  },
  renderPagination(totalPages) {
    const el = document.createElement("div");
    el.className = "pagination flex items-center justify-center gap-4 mt-[30px] pt-1 max-[480px]:gap-2.5";
    const pagesHtml = this.getPageButtons(this.currentPage, totalPages).map(item => {
      if (item === "...") return '<span class="pagination-ellipsis inline-flex items-center justify-center w-6 text-[rgba(244,244,244,0.72)] text-[14px]">...</span>';
      return '<button type="button" class="pagination-page inline-flex items-center justify-center w-[38px] h-[38px] text-[14px] font-bold text-[#F4F4F4] bg-[#1E1E1E] border border-[rgba(244,244,244,0.15)] rounded-[10px] cursor-pointer transition-colors hover:bg-[rgba(255,107,53,0.2)] hover:border-[#FF6B35] max-[480px]:w-[34px] max-[480px]:h-[34px]' + (item === this.currentPage ? " pagination-page-active bg-[#FF6B35] border-[#FF6B35]" : "") + '" data-page="' + item + '">' + item + '</button>';
    }).join("");
    el.innerHTML =
      '<button type="button" class="pagination-btn pagination-prev inline-flex items-center justify-center min-w-[96px] h-[42px] px-5 text-[14px] font-bold tracking-[0.4px] uppercase text-[#F4F4F4] bg-[#1E1E1E] border border-[rgba(244,244,244,0.15)] rounded-xl cursor-pointer transition-colors hover:bg-[#FF6B35] hover:border-[#FF6B35] disabled:opacity-[0.35] disabled:cursor-not-allowed max-[480px]:min-w-[84px] max-[480px]:px-3.5 max-[480px]:h-10"' + (this.currentPage === 1 ? " disabled" : "") + '>Prev</button>' +
      '<div class="pagination-pages flex items-center justify-center gap-1.5 flex-wrap max-[480px]:gap-1">' + pagesHtml + '</div>' +
      '<button type="button" class="pagination-btn pagination-next inline-flex items-center justify-center min-w-[96px] h-[42px] px-5 text-[14px] font-bold tracking-[0.4px] uppercase text-[#F4F4F4] bg-[#1E1E1E] border border-[rgba(244,244,244,0.15)] rounded-xl cursor-pointer transition-colors hover:bg-[#FF6B35] hover:border-[#FF6B35] disabled:opacity-[0.35] disabled:cursor-not-allowed max-[480px]:min-w-[84px] max-[480px]:px-3.5 max-[480px]:h-10"' + (this.currentPage === totalPages ? " disabled" : "") + '>Next</button>';
    return el;
  },

  bindPagination() {
    const container = document.querySelector(".cards");
    if (!container) return;
    container.querySelector(".pagination-prev")?.addEventListener("click", () => this.prevPage());
    container.querySelector(".pagination-next")?.addEventListener("click", () => this.nextPage());
    container.querySelectorAll(".pagination-page").forEach(btn => {
      btn.addEventListener("click", () => this.goToPage(parseInt(btn.dataset.page, 10)));
    });
  },

  goToPage(page) {
    if (isNaN(page) || page < 1) return;
    const games = this.getFilteredGames();
    const totalPages = Math.max(1, Math.ceil(games.length / this.getPageSize()));
    if (page > totalPages) return;
    this.currentPage = page;
    this.renderCards();
    window.scrollTo(0, 0);
  },

  changePage(delta) {
    this.currentPage += delta;
    this.renderCards();
    window.scrollTo(0, 0);
  },

  prevPage() {
    this.changePage(-1);
  },

  nextPage() {
    this.changePage(1);
  },

  createCard(game) {
    const wrapper = document.createElement("div");
    wrapper.className = "card-wrapper cards-" + game.id + " flex items-stretch w-full cursor-pointer min-w-0 transition-[filter,transform] duration-200 hover:brightness-[1.08] hover:-translate-y-0.5 max-[640px]:flex-col max-[640px]:items-center";
    wrapper.addEventListener("click", () => this.openModal(game.id));

    const isDropped = game.status === "dropped";
    const dotClass = isDropped ? "bg-[#f01]" : "bg-[#FF9F1C]";
    const statusClass = isDropped ? "text-[#ff3c49]" : "text-[#FF9F1C]";
    const reviewText = game.review || "";
    const scoreHtml = game.hasScore
      ? '<div class="card-group inline-block font-extrabold text-[#FF6B35] bg-[#262626] px-2.5 py-0.5 rounded-[20px] leading-[1.3] text-[clamp(24px,4vw,36px)]">' + game.score + '/10</div>'
      : '<div class="card-group card-group-na inline-block font-extrabold text-[rgba(255,107,53,0.4)] bg-[#262626] rounded-[20px] leading-none tracking-[0.5px] text-[16px] px-3.5 py-2">Unrated</div>';

    wrapper.innerHTML =
      '<div class="poster-col relative w-[192px] min-w-0 shrink-0 overflow-hidden rounded-lg flex">' +
        '<img src="' + game.img + '" alt="' + game.imgAlt + '" class="poster-col-img w-full h-full object-cover block flex-1" />' +
        '<div class="status-badge absolute bottom-2 right-0 mr-1.5 z-[2] max-[640px]:top-2 max-[640px]:bottom-auto max-[640px]:right-2 max-[640px]:m-0">' +
          '<button class="btn-label btn-label1 flex items-center justify-center gap-1.5 bg-[#1E1E1E] rounded-[23px] px-3.5 py-1 hover:brightness-[1.2]">' +
            '<div class="btn-label-icon w-[10px] h-[10px] rounded-full shrink-0 -ml-px ' + dotClass + '"></div>' +
            '<p class="btn-label-finished capitalize font-bold leading-none ' + statusClass + '">' + game.status + '</p>' +
          '</button>' +
        '</div>' +
      '</div>' +
      '<div class="card-a card2 w-full max-w-[557px] min-h-[250px] flex flex-col gap-4 shrink-0 text-left bg-[#1E1E1E] pt-[17px] pr-[30px] pb-9 pl-[30px] rounded-[10px] min-[901px]:h-full min-[901px]:min-h-0 max-[640px]:max-w-full">' +
        '<h2 class="card-subtitle2 text-[#FF6B35] text-[clamp(20px,3vw,32px)] font-extrabold leading-none max-[480px]:text-center">' + game.title + '</h2>' +
        '<div class="card-row-inner flex items-start gap-5 flex-1 min-w-0 min-[901px]:items-stretch max-[480px]:flex-col max-[480px]:items-center max-[480px]:gap-4">' +
          '<div class="card-score-col w-auto min-w-[80px] shrink-0 flex flex-col items-center gap-1.5 max-[480px]:w-full max-[480px]:min-w-[60px]">' +
            '<p class="card-text-your-score2 text block pb-2 font-bold text-[#FF9F1C] text-[16px] max-[480px]:text-[13px] max-[480px]:text-center">Your Score :</p>' +
            scoreHtml +
          '</div>' +
          '<div class="review-box border border-transparent rounded-md px-3 py-2.5 h-[120px] text-[14px] leading-[1.5] text-[rgba(244,244,244,0.72)] break-words overflow-y-auto min-w-0 w-full flex flex-col justify-start box-border min-[901px]:h-auto min-[901px]:flex-1 min-[901px]:min-h-0 max-[640px]:bg-transparent">' + reviewText + '</div>' +
        '</div>' +
      '</div>';

    return wrapper;
  },

  initSearch() {
    const input = document.querySelector(".sort-bar-search-input");
    if (!input) return;
    let debounceTimer;
    input.addEventListener("input", () => {
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => {
        this.searchQuery = input.value;
        this.currentPage = 1;
        this.renderCards();
      }, 200);
    });
  },

  initModal() {
    const overlay = document.querySelector(".over");
    if (!overlay) return;
    overlay.querySelector(".over-btn")?.addEventListener("click", () => this.closeModal());
    overlay.querySelector(".over-text-btn8")?.addEventListener("click", () => this.closeModal());
    overlay.querySelectorAll(".over-btn-score, .over-text-button, .over-btn-active").forEach(el => {
      el.addEventListener("click", () => {
        const score = parseInt(el.textContent.trim());
        if (!isNaN(score)) this.selectScore(score);
      });
    });
    const textarea = overlay.querySelector(".input-group-review-input");
    const charCount = overlay.querySelector(".input-group-review-text");
    if (textarea && charCount) {
      textarea.addEventListener("input", () => {
        let len = textarea.value.length;
        if (len > 180) {
          textarea.value = textarea.value.slice(0, 180);
          len = 180;
        }
        charCount.textContent = len + "/180";
      });
    }
    overlay.querySelector(".btn1")?.addEventListener("click", () => this.submitReview());
    if (textarea) {
      textarea.addEventListener("keydown", (e) => {
        if (e.key === "Enter" && !e.shiftKey) {
          e.preventDefault();
          this.submitReview();
        }
      });
    }
    document.querySelector(".over-backdrop")?.addEventListener("click", () => this.closeModal());
  },

  openModal(gameId) {
    this.selectedGameId = gameId;
    const game = this.games.find(g => g.id === gameId);
    if (!game) return;
    const overlay = document.querySelector(".over");
    if (!overlay) return;
    const titleEl = overlay.querySelector(".over-title");
    if (titleEl) titleEl.innerHTML = 'Rate &amp; Review <span class="sub-text-light text-[#FF9F1C]">' + game.title + '</span>';
    this.selectScore(game.score || 0);
    const textarea = overlay.querySelector(".input-group-review-input");
    const charCount = overlay.querySelector(".input-group-review-text");
    if (textarea) {
      textarea.value = (game.review || "").slice(0, 180);
      if (charCount) charCount.textContent = (textarea.value.length) + "/180";
    }
    overlay.classList.add("flex"); overlay.classList.remove("hidden");
    document.querySelector(".over-backdrop")?.classList.add("block"); document.querySelector(".over-backdrop")?.classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
  },

  closeModal() {
    const overlay = document.querySelector(".over");
    if (overlay) overlay.classList.remove("flex"); overlay.classList.add("hidden");
    document.querySelector(".over-backdrop")?.classList.remove("block"); document.querySelector(".over-backdrop")?.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
    this.selectedGameId = null;
  },

  selectScore(score) {
    const overlay = document.querySelector(".over");
    if (!overlay) return;
    const items = overlay.querySelectorAll(".over-btn-score, .over-text-button");
    const selectedClasses = ["over-btn-selected", "bg-[#FF6B35]", "border-[#FF6B35]", "text-[#F4F4F4]", "shadow-[0_0_20px_rgba(255,107,53,0.3)]"];
    items.forEach(el => selectedClasses.forEach(c => el.classList.remove(c)));
    if (score > 0) {
      items.forEach(el => {
        if (parseInt(el.textContent.trim()) === score) {
          selectedClasses.forEach(c => el.classList.add(c));
        }
      });
    }
  },

  submitReview() {
    if (!this.selectedGameId) return;
    const game = this.games.find(g => g.id === this.selectedGameId);
    if (!game) return;
    const overlay = document.querySelector(".over");
    const textarea = overlay?.querySelector(".input-group-review-input");
    const selectedEl = overlay?.querySelector(".over-btn-selected");
    const score = selectedEl ? parseInt(selectedEl.textContent.trim()) : null;
    const review = textarea ? textarea.value.trim() : "";

    const body = { score: score, review: review };
    const token = document.querySelector('meta[name="csrf-token"]')?.content;

    fetch(`/personal-score/${game.id}`, {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": token,
        "Accept": "application/json",
        "Content-Type": "application/json"
      },
      body: JSON.stringify(body)
    }).then(response => {
      if (!response.ok) throw new Error("Failed to save review");
      if (score !== null) {
        game.score = score;
        game.hasScore = true;
      }
      game.review = review;
      this.closeModal();
      this.renderCards();
    }).catch(() => {
      this.closeModal();
    });
  }
};

document.addEventListener("DOMContentLoaded", () => App.init());

export default App;

