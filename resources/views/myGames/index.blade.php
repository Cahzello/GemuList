@extends('index')

@section('content')
    <div class="bg-[#141414] bg-[radial-gradient(ellipse_at_top,_#2a2a2a_0%,_#181818_55%,_#141414_100%)] bg-fixed text-[#F4F4F4] font-sans m-0 min-h-screen"
        x-data="myGames()" x-init="init()">
        <div class="page min-h-screen bg-transparent">
            <main class="main max-w-[1400px] mx-auto pt-24 sm:pt-32 lg:pt-36 pb-20 px-4 sm:px-8 lg:px-12">
                <div class="header-container mb-8 sm:mb-12">
                    <h1
                        class="page-title font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl uppercase tracking-wider bg-gradient-to-r from-[#FF6B35] to-[#FF9F1C] bg-clip-text text-transparent mb-3 sm:mb-4 inline-block leading-tight">
                        My Games
                    </h1>
                    <p
                        class="page-desc font-sans font-normal text-sm sm:text-base text-zinc-400 max-w-2xl leading-relaxed m-0">
                        Manage your personal library. Track what you're playing, what you've
                        conquered, and what's next on your journey through the digital
                        realms.
                    </p>
                </div>

                <div class="content-row flex flex-col lg:flex-row items-stretch lg:items-start gap-6 w-full">
                    <!-- LEFT COLUMN: COLLECTION LIST -->
                    <section class="collection-panel relative flex-1 min-w-0 bg-transparent border-0 flex flex-col w-full">
                        <div class="collection-list flex flex-col gap-4 p-0 flex-1 w-full">
                            <template x-for="(game, index) in paginatedGames" :key="game.id">
                                <article
                                    class="game-card relative flex flex-col sm:flex-row gap-5 sm:gap-6 p-4 sm:p-6 bg-[#1E1E1E] border border-white/10 rounded-2xl z-10 transition-all duration-200 hover:border-[#FF6B35]/40 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/50 w-full box-border"
                                    style="animation: fadeIn 0.3s ease">
                                    <div class="card-accent absolute left-0 top-0 bottom-0 w-1.5 rounded-l-2xl"
                                        :style="'background:' + statusColor(game.status)"></div>
                                    <div
                                        class="card-cover flex-shrink-0 w-full sm:w-[148px] h-[200px] rounded-xl overflow-hidden bg-gradient-to-br from-zinc-800 to-zinc-950">
                                        <img :src="game.cover" :alt="game.title"
                                            class="w-full h-full object-cover block" />
                                    </div>
                                    <div class="card-body flex-1 min-w-0 flex flex-col justify-start gap-4 pt-1">
                                        <div class="card-title-row flex items-start justify-between gap-3">
                                            <h3 class="card-title font-display font-bold text-lg sm:text-xl text-[#F4F4F4] leading-snug m-0"
                                                x-text="game.title"></h3>
                                            <button
                                                class="icon-btn flex-shrink-0 w-8 h-8 flex items-center justify-center bg-transparent border-0 rounded-lg cursor-pointer hover:bg-white/10 transition-colors"
                                                aria-label="Delete game" @click.stop="openDeleteModal(game)">
                                                <svg width="16" height="18" viewBox="0 0 16 18" fill="none">
                                                    <path d="M1 4H15" stroke="#FF6B35" stroke-width="1.4"
                                                        stroke-linecap="round" />
                                                    <path
                                                        d="M5.5 4V2.2C5.5 1.8 5.85 1.5 6.25 1.5H9.75C10.15 1.5 10.5 1.8 10.5 2.2V4"
                                                        stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                                                    <path
                                                        d="M2.5 4L3.2 16C3.25 16.6 3.75 17 4.3 17H11.7C12.25 17 12.75 16.6 12.8 16L13.5 4"
                                                        stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M6.3 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                        stroke-linecap="round" />
                                                    <path d="M9.7 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                        stroke-linecap="round" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="card-status-block flex flex-col gap-2 w-full sm:max-w-[220px]">
                                            <span
                                                class="field-label font-mono text-xs font-medium text-zinc-400">Status</span>
                                            <div class="relative" @click.outside="game.dropdownOpen = false">
                                                <button
                                                    class="status-select relative flex items-center gap-2.5 px-3.5 py-2.5 bg-white/[0.03] border border-white/10 rounded-xl cursor-pointer w-full text-left"
                                                    @click.stop="toggleDropdown(game)">
                                                    <svg class="status-chevron" width="15" height="15"
                                                        viewBox="0 0 21 21" fill="none">
                                                        <path d="M6 7.5L10.5 12L15 7.5" stroke="#6B7280"
                                                            stroke-width="1.575" />
                                                    </svg>
                                                    <span class="font-mono text-sm font-medium"
                                                        :class="statusTextClass(game.status)"
                                                        x-text="statusLabel(game.status)"></span>
                                                </button>
                                                <div class="status-dropdown" x-show="game.dropdownOpen"
                                                    x-transition:enter="transition ease-out duration-200"
                                                    x-transition:enter-start="opacity-0 -translate-y-2"
                                                    x-transition:enter-end="opacity-100 translate-y-0"
                                                    x-transition:leave="transition ease-in duration-150"
                                                    x-transition:leave-start="opacity-100 translate-y-0"
                                                    x-transition:leave-end="opacity-0 -translate-y-2">
                                                    <template x-for="opt in statusOptions" :key="opt.value">
                                                        <button class="status-option"
                                                            @click.stop="setStatus(game, opt.value)"
                                                            x-text="opt.label"></button>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </template>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination-controls" x-show="totalPages > 1">
                            <button class="page-btn page-prev" :class="{ 'disabled': currentPage === 1 }"
                                :disabled="currentPage === 1" @click="prevPage()">
                                <svg width="8" height="12" viewBox="0 0 8 12" fill="none">
                                    <path d="M6 10L2 6L6 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                                Prev
                            </button>
                            <div class="flex gap-1">
                                <template x-for="page in totalPages" :key="page">
                                    <button class="page-number-btn" :class="{ 'active': page === currentPage }"
                                        @click="goToPage(page)" x-text="page"></button>
                                </template>
                            </div>
                            <button class="page-btn page-next" :class="{ 'disabled': currentPage === totalPages }"
                                :disabled="currentPage === totalPages" @click="nextPage()">
                                Next
                                <svg width="8" height="12" viewBox="0 0 8 12" fill="none">
                                    <path d="M2 2L6 6L2 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </section>

                    <!-- RIGHT COLUMN: SIDEBAR FILTERS -->
                    <aside class="sidebar w-full lg:w-[320px] flex-shrink-0 order-first lg:order-last">
                        <div
                            class="sidebar-panel relative bg-[#1E1E1E] border border-white/10 rounded-2xl p-5 sm:p-7 flex flex-col gap-6 w-full">
                            <div class="sidebar-heading flex items-center gap-3 pb-4 border-b border-white/10">
                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none">
                                    <path d="M0 1H18" stroke="#FF6B35" stroke-width="1.5" />
                                    <path d="M3 6H15" stroke="#FF6B35" stroke-width="1.5" />
                                    <path d="M6 11H12" stroke="#FF6B35" stroke-width="1.5" />
                                </svg>
                                <span class="font-display font-semibold text-base text-[#F4F4F4] tracking-wide">Filter
                                    & Sort</span>
                            </div>

                            <!-- Search -->
                            <div class="filter-group flex flex-col gap-2">
                                <label class="filter-label font-mono text-xs font-medium text-zinc-400">Search</label>
                                <div class="relative">
                                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                                        width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <circle cx="7" cy="7" r="5.5" stroke="#6B7280"
                                            stroke-width="1.3" />
                                        <path d="M11 11L14.5 14.5" stroke="#6B7280" stroke-width="1.3"
                                            stroke-linecap="round" />
                                    </svg>
                                    <input type="text"
                                        class="search-input w-full py-2.5 pl-10 pr-4 bg-white/[0.03] border border-white/10 rounded-xl text-[#F4F4F4] font-mono text-sm placeholder:text-zinc-500 outline-none focus:border-[#FF6B35]/50 transition-colors"
                                        placeholder="Search games..." x-model="searchTerm" @input="currentPage = 1" />
                                </div>
                            </div>

                            <!-- Sort -->
                            <div class="filter-group flex flex-col gap-2">
                                <label class="filter-label font-mono text-xs font-medium text-zinc-400">Sort
                                    by</label>
                                <div class="sort-buttons flex gap-2">
                                    <button
                                        class="sort-btn flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border font-mono text-sm font-medium transition-all duration-200"
                                        :class="currentSort === 'asc' ?
                                            'bg-[#FF6B35]/15 border-[#FF6B35]/30 text-[#FF6B35]' :
                                            'bg-white/[0.03] border-white/10 text-zinc-400 hover:border-white/20'"
                                        @click="currentSort = 'asc'; currentPage = 1">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M3 9L7 5L11 9" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </svg>
                                        <span>A → 0</span>
                                    </button>
                                    <button
                                        class="sort-btn flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border font-mono text-sm font-medium transition-all duration-200"
                                        :class="currentSort === 'desc' ?
                                            'bg-[#FF6B35]/15 border-[#FF6B35]/30 text-[#FF6B35]' :
                                            'bg-white/[0.03] border-white/10 text-zinc-400 hover:border-white/20'"
                                        @click="currentSort = 'desc'; currentPage = 1">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                                            <path d="M3 5L7 9L11 5" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </svg>
                                        <span>0 → A</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Status Filters -->
                            <div class="filter-group flex flex-col gap-2">
                                <label class="filter-label font-mono text-xs font-medium text-zinc-400">Status</label>
                                <div class="checkbox-list flex flex-col gap-3 mt-1">
                                    <template x-for="filter in filterItems" :key="filter.key">
                                        <label class="checkbox-item flex items-center gap-3 cursor-pointer select-none"
                                            @click.prevent="filter.checked = !filter.checked">
                                            <span
                                                class="flex-shrink-0 w-[18px] h-[18px] rounded-md border flex items-center justify-center"
                                                :class="filter.checked ? 'border-[#FF6B35] bg-[#FF6B35] checkbox checked' :
                                                    'border-white/10 bg-white/[0.03] checkbox'">
                                                <svg width="9.51" height="7.01" viewBox="0 0 10 8" fill="none">
                                                    <path d="M1 4L3.5 6.5L9 1" stroke="#FFFFFF" stroke-width="1.5" />
                                                </svg>
                                            </span>
                                            <span class="font-mono text-sm" :style="'color:' + filter.color"
                                                x-text="filter.label"></span>
                                        </label>
                                    </template>
                                </div>
                            </div>

                            <button
                                class="apply-btn mt-1 w-full py-3.5 bg-[#FF6B35] hover:bg-[#E85A24] border-0 rounded-xl text-white font-display font-bold text-base cursor-pointer shadow-lg shadow-[#FF6B35]/35 transition-all duration-200 active:scale-95"
                                @click="currentPage = 1">
                                Apply Changes
                            </button>
                        </div>
                    </aside>
                </div>
            </main>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="delete-modal-overlay fixed inset-0 bg-black/75 items-center justify-center z-[9999] backdrop-blur-sm"
            :class="showDeleteModal ? 'flex' : 'hidden'" x-show="showDeleteModal"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="closeDeleteModal()"
            @keydown.escape.window="closeDeleteModal()">
            <div
                class="delete-modal bg-[#1E1E1E] border border-white/10 rounded-2xl p-8 sm:p-10 max-w-[370px] w-[90%] text-center shadow-2xl">
                <div
                    class="delete-icon w-20 h-20 bg-[#FF6B35]/15 border border-[#FF6B35]/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg width="32" height="36" viewBox="0 0 16 18" fill="none">
                        <path d="M1 4H15" stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                        <path d="M5.5 4V2.2C5.5 1.8 5.85 1.5 6.25 1.5H9.75C10.15 1.5 10.5 1.8 10.5 2.2V4" stroke="#FF6B35"
                            stroke-width="1.4" stroke-linecap="round" />
                        <path d="M2.5 4L3.2 16C3.25 16.6 3.75 17 4.3 17H11.7C12.25 17 12.75 16.6 12.8 16L13.5 4"
                            stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.3 7.5V13.5" stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                        <path d="M9.7 7.5V13.5" stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                    </svg>
                </div>
                <h2
                    class="delete-modal-title font-display font-semibold text-xl sm:text-2xl text-[#F4F4F4] m-0 mb-8 tracking-tight">
                    Delete this game?
                </h2>
                <div class="delete-modal-buttons flex gap-3">
                    <button
                        class="delete-btn-confirm flex-1 py-3.5 px-6 bg-[#FF6B35] hover:bg-[#E85A24] border-0 rounded-xl text-white font-display font-semibold text-base cursor-pointer transition-all duration-200 active:scale-95"
                        @click="confirmDelete()">
                        Delete
                    </button>
                    <button
                        class="delete-btn-cancel flex-1 py-3.5 px-6 bg-transparent border-1.5 border-white/15 hover:border-white/30 hover:bg-white/5 rounded-xl text-[#F4F4F4] font-display font-semibold text-base cursor-pointer transition-all duration-200 active:scale-95"
                        @click="closeDeleteModal()">
                        No
                    </button>
                </div>
            </div>
        </div>

        <script>
            function myGames() {
                return {
                    games: @json($games),

                    searchTerm: '',
                    currentSort: 'asc',
                    currentPage: 1,

                    showDeleteModal: false,
                    gameToDelete: null,

                    statusOptions: [{
                            value: 'planning',
                            label: 'Planning'
                        },
                        {
                            value: 'progress',
                            label: 'On Progress'
                        },
                        {
                            value: 'finished',
                            label: 'Finished'
                        },
                        {
                            value: 'dropped',
                            label: 'Dropped'
                        }
                    ],

                    filterItems: [{
                            key: 'planning',
                            label: 'Planning',
                            checked: true,
                            color: '#A0A0A0'
                        },
                        {
                            key: 'progress',
                            label: 'On Progress',
                            checked: true,
                            color: '#FF9F1C'
                        },
                        {
                            key: 'finished',
                            label: 'Finished',
                            checked: true,
                            color: '#22C55E'
                        },
                        {
                            key: 'dropped',
                            label: 'Dropped',
                            checked: false,
                            color: '#FF6B35'
                        }
                    ],

                    init() {
                        this.$watch('windowWidth', () => {});
                    },

                    get gamesPerPage() {
                        return window.innerWidth < 640 ? 3 : 5;
                    },

                    get activeFilters() {
                        let map = {};
                        this.filterItems.forEach(f => map[f.key] = f.checked);
                        return map;
                    },

                    get filteredGames() {
                        let term = this.searchTerm.toLowerCase().trim();
                        let filtered = this.games.filter(game => {
                            let matchesSearch = !term || game.title.toLowerCase().includes(term);
                            let matchesFilter = this.activeFilters[game.status];
                            return matchesSearch && matchesFilter;
                        });

                        filtered.sort((a, b) => {
                            if (this.currentSort === 'asc') {
                                return a.title.localeCompare(b.title);
                            } else {
                                return b.title.localeCompare(a.title);
                            }
                        });

                        return filtered;
                    },

                    get totalPages() {
                        return Math.max(1, Math.ceil(this.filteredGames.length / this.gamesPerPage));
                    },

                    get paginatedGames() {
                        let start = (this.currentPage - 1) * this.gamesPerPage;
                        return this.filteredGames.slice(start, start + this.gamesPerPage);
                    },

                    goToPage(page) {
                        this.currentPage = page;
                    },

                    prevPage() {
                        if (this.currentPage > 1) this.currentPage--;
                    },

                    nextPage() {
                        if (this.currentPage < this.totalPages) this.currentPage++;
                    },

                    statusColor(status) {
                        const colors = {
                            planning: '#a0a0a0',
                            progress: '#ff9f1c',
                            finished: '#22c55e',
                            dropped: '#ff6b35'
                        };
                        return colors[status] || '#a0a0a0';
                    },

                    statusLabel(status) {
                        const labels = {
                            planning: 'Planning',
                            progress: 'On Progress',
                            finished: 'Finished',
                            dropped: 'Dropped'
                        };
                        return labels[status] || 'Planning';
                    },

                    statusTextClass(status) {
                        const classes = {
                            planning: 'text-[#A0A0A0]',
                            progress: 'text-[#FF9F1C]',
                            finished: 'text-[#22C55E]',
                            dropped: 'text-[#FF6B35]'
                        };
                        return classes[status] || 'text-[#A0A0A0]';
                    },

                    toggleDropdown(game) {
                        let wasOpen = game.dropdownOpen;
                        this.games.forEach(g => g.dropdownOpen = false);
                        game.dropdownOpen = !wasOpen;
                    },

                    openDeleteModal(game) {
                        this.gameToDelete = game;
                        this.showDeleteModal = true;
                    },

                    closeDeleteModal() {
                        this.showDeleteModal = false;
                        this.gameToDelete = null;
                    },

                    confirmDelete() {
                        if (!this.gameToDelete) return;

                        fetch(`/my-games/${this.gameToDelete.id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                                'Accept': 'application/json'
                            }
                        }).then(response => {
                            if (!response.ok) throw new Error('Gagal menghapus game');
                            this.games = this.games.filter(g => g.id !== this.gameToDelete.id);
                            if (this.currentPage > this.totalPages) {
                                this.currentPage = Math.max(1, this.totalPages);
                            }
                            this.closeDeleteModal();
                        }).catch(() => {
                            this.closeDeleteModal();
                        });
                    },

                    setStatus(game, status) {
                        let previous = game.status;
                        game.status = status;
                        game.dropdownOpen = false;

                        fetch(`/my-games/${game.id}`, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ status: status })
                        }).then(response => {
                            if (!response.ok) throw new Error('Gagal mengubah status');
                        }).catch(() => {
                            game.status = previous;
                        });
                    }
                };
            }
        </script>
    </div>
@endsection
