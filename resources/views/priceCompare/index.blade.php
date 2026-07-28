<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Price Compare</title>
    @vite(['resources/css/priceCompare.css', 'resources/js/db.js', 'resources/js/script.js'])
</head>

<body>

    <div class="page">

        <header class="hero">
            <h1 class="hero-title">Game Price Compare</h1>
            <p class="hero-subtitle">Compare prices across all major digital stores. Find the best deals for your
                favorite titles and save more on your gaming library.</p>

            <div class="search-bar">
                <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" />
                    <line x1="16.65" y1="16.65" x2="21" y2="21" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" />
                </svg>
                <input type="text" id="searchInput" placeholder="The Witcher" autocomplete="off">
            </div>
        </header>

        <main class="content">

            <section class="results-panel">
                <span class="panel-label">SEARCH RESULT</span>
                <div class="results-list" id="resultsList">
                    <!-- result cards injected by JS -->
                </div>
            </section>

            <section class="store-panel">
                <span class="panel-label store-label">AVAILABLE STORE</span>
                <div class="store-card">
                    <h2 class="store-game-title" id="storeGameTitle">—</h2>
                    <ul class="store-list" id="storeList">
                        <!-- store rows injected by JS -->
                    </ul>
                </div>
            </section>

        </main>

    </div>

    <script src="db.js"></script>
    <script src="script.js"></script>
</body>

</html>