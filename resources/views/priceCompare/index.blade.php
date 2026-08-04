<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Price Compare</title>
    @vite(['resources/css/app.css', 'resources/css/priceCompare.css', 'resources/js/dbPriceCompare.js', 'resources/js/priceCompare.js'])
</head>

<body class="price-compare-page min-h-screen text-neutral-50 p-6 md:p-10">

    <div class="max-w-[1000px] mx-auto h-[calc(100vh-3rem)] md:h-[calc(100vh-5rem)] flex flex-col">

        <header class="text-center mb-6 flex-shrink-0">
            <h1 class="text-4xl font-bold tracking-tight gradient-text mb-3">Game Price Compare</h1>
            <p class="text-[#C0C0C0] text-sm leading-relaxed max-w-[460px] mx-auto mb-5">
                Compare prices across all major digital stores. Find the best deals for your favorite titles and save more on your gaming library.
            </p>

            <div class="search-container flex items-center gap-2.5 max-w-[460px] mx-auto bg-[#1E1E1E] border-2 border-[#2a2a2a] rounded-xl px-4 py-3 transition-all">
                <svg class="search-icon text-[#808080] flex-shrink-0 transition-colors" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" />
                    <line x1="16.65" y1="16.65" x2="21" y2="21" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" />
                </svg>
                <input type="text" id="searchInput" placeholder="Search Game" autocomplete="off" 
                    class="flex-1 bg-transparent border-none outline-none text-[#F4F4F4] text-sm placeholder:text-[#808080]">
            </div>
        </header>

        <!-- Mobile Tab Switcher -->
        <div class="hidden max-md:flex gap-2 mb-5 flex-shrink-0 mobile-tabs">
            <button class="tab-btn flex-1 flex items-center justify-center gap-2 bg-[#1E1E1E] border border-[#2a2a2a] rounded-xl px-4 py-3 text-[#C0C0C0] text-sm font-semibold transition-all hover:border-[#33385a] hover:text-[#F4F4F4] active" data-tab="results">
                <svg class="flex-shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2" fill="none"/>
                    <rect x="14" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2" fill="none"/>
                    <rect x="3" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2" fill="none"/>
                    <rect x="14" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
                Games
            </button>
            <button class="tab-btn flex-1 flex items-center justify-center gap-2 bg-[#1E1E1E] border border-[#2a2a2a] rounded-xl px-4 py-3 text-[#C0C0C0] text-sm font-semibold transition-all hover:border-[#33385a] hover:text-[#F4F4F4]" data-tab="store">
                <svg class="flex-shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <polyline points="9 22 9 12 15 12 15 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Stores
            </button>
        </div>

        <main class="grid md:grid-cols-[1.8fr_2fr] gap-6 flex-1 min-h-0">

            <section class="results-panel flex flex-col min-h-0 max-md:hidden" id="resultsPanel">
                <span class="block text-[11px] font-bold tracking-[0.12em] text-[#FF9F1C] mb-3.5 flex-shrink-0">GAME LIST</span>
                <div class="results-list flex-1 flex flex-col gap-3 overflow-y-auto pr-2 custom-scrollbar" id="resultsList">
                    <!-- result cards injected by JS -->
                </div>
            </section>

            <section class="store-panel flex flex-col min-h-0 max-md:hidden" id="storePanel">
                <span class="block text-[11px] font-bold tracking-[0.12em] text-[#FF9F1C] mb-3.5 flex-shrink-0">AVAILABLE STORE</span>
                <div class="bg-[#1E1E1E] border border-[#2a2a2a] rounded-2xl p-5 flex flex-col min-h-0 flex-1 relative z-[1]">
                    <h2 class="text-[17px] font-bold text-[#FF6B35] mb-3.5 flex-shrink-0" id="storeGameTitle">—</h2>
                    <ul class="list-none flex-1 flex flex-col overflow-y-auto pr-2 custom-scrollbar" id="storeList">
                        <!-- store rows injected by JS -->
                    </ul>
                </div>
            </section>

        </main>

    </div>

    <script src="dbPriceCompare.js"></script>
    <script src="priceCompare.js"></script>
</body>

</html>