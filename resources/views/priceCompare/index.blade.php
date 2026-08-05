<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Price Compare</title>
    @vite(['resources/css/app.css', 'resources/css/priceCompare.css'])
</head>

<body class="price-compare-page min-h-screen text-neutral-50">
    <x-navbar />

    <div class="max-w-[1000px] mx-auto px-6 pt-24 pb-6 md:px-10 md:pt-28 md:pb-8">

        <header class="page-header">
            <h1 class="page-title gradient-text">Game Price Compare</h1>
            <p class="page-description">
                Compare prices across all major digital stores. Find the best deals for your favorite titles and save more on your gaming library.
            </p>

            <div
                class="search-container flex items-center gap-2.5 max-w-[460px] mx-auto bg-[#1E1E1E] border-2 border-[#2a2a2a] rounded-xl px-4 py-3 transition-all">
                <svg class="search-icon text-[#808080] flex-shrink-0 transition-colors" width="18" height="18"
                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" />
                    <line x1="16.65" y1="16.65" x2="21" y2="21" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" />
                </svg>
                <input type="text" id="searchInput" placeholder="Search Game" autocomplete="off"
                    class="flex-1 bg-transparent border-none outline-none text-[#F4F4F4] text-sm placeholder:text-[#808080]">
            </div>
        </header>

        <!-- Mobile Tabs -->
        <div class="mobile-tabs">
            <button class="tab-btn active" data-tab="games">
                <svg class="flex-shrink-0" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2" fill="none"/>
                    <rect x="14" y="3" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2" fill="none"/>
                    <rect x="3" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2" fill="none"/>
                    <rect x="14" y="14" width="7" height="7" rx="1" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
                <span>Games</span>
            </button>
            <button class="tab-btn" data-tab="stores">
                <svg viewBox="0 0 256 256" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M96,216a16,16,0,1,1-16-16A16,16,0,0,1,96,216Zm88-16a16,16,0,1,0,16,16A16,16,0,0,0,184,200ZM231.65,74.35l-28.53,92.71A23.89,23.89,0,0,1,180.18,184H84.07A24.11,24.11,0,0,1,61,166.59L24.82,40H8A8,8,0,0,1,8,24H24.82A16.08,16.08,0,0,1,40.21,35.6L48.32,64H224a8,8,0,0,1,7.65,10.35ZM213.17,80H52.89l23.49,82.2a8,8,0,0,0,7.69,5.8h96.11a8,8,0,0,0,7.65-5.65Z" fill="currentColor"/>
                </svg>
                <span>Stores</span>
            </button>
        </div>

        <main class="grid md:grid-cols-[1.8fr_2fr] gap-6 mb-8" style="min-height: 500px;">

            <section class="results-panel flex flex-col" style="max-height: 600px;">
                <span class="block text-[11px] font-bold tracking-[0.12em] text-[#FF9F1C] mb-3.5">SEARCH RESULT</span>
                <div class="results-list flex-1 flex flex-col gap-3 overflow-y-auto pr-2 custom-scrollbar"
                    id="resultsList">
                    <!-- result cards injected by JS -->
                </div>
            </section>

            <section class="store-panel flex flex-col" id="storePanel" style="max-height: 600px;">
                <span
                    class="block text-[11px] font-bold tracking-[0.12em] text-[#FF9F1C] mb-3.5">AVAILABLE
                    STORE</span>
                <div
                    class="bg-[#1E1E1E] border border-[#2a2a2a] rounded-2xl p-5 flex flex-col relative z-[1]" style="height: 100%;">
                    <h2 class="text-[17px] font-bold text-[#FF6B35] mb-3.5" id="storeGameTitle">—</h2>
                    <ul class="list-none flex-1 overflow-y-auto pr-2 custom-scrollbar" id="storeList">
                        <!-- store rows injected by JS -->
                    </ul>
                </div>
            </section>

        </main>

    </div>

    <x-footer />

    <script>
        window.games = @json($games);
    </script>

    @vite(['resources/js/priceCompare.js'])
</body>

</html>
