{{--
    resources/views/search/search-results.blade.php
    Section: Search Results (grid style sama seperti GL06)
    CSS terkait: resources/css/search-results.css

    Grid sudah otomatis wrap: maksimal 5 card per baris (grid-template-columns:
    repeat(5, 1fr) di CSS), card ke-6 dan seterusnya otomatis lanjut ke baris
    berikutnya tanpa perlu logic tambahan di sini.
--}}

@php
    // ==== DATA DUMMY – ganti dengan hasil query dari controller/database ====
    // Sengaja dibuat lebih dari 5 item supaya kelihatan efek wrap ke baris baru
    $allGames = [
                    [
                        'title' => 'Cyberpunk 2077',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Elden Ring',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => "Baldur's Gate 3",
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Valorant',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Starfield',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Red Dead Redemption 2',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'The Witcher 3',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'God of War Ragnarök',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Hogwarts Legacy',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Call of Duty: Modern Warfare',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Diablo IV',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Final Fantasy XVI',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Resident Evil 4',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Street Fighter 6',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Mortal Kombat 1',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Counter-Strike 2',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'League of Legends',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Dota 2',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Overwatch 2',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Apex Legends',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Fortnite',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Minecraft',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Terraria',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Stardew Valley',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'The Sims 4',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Cities: Skylines',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Civilization VI',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'XCOM 2',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Total War: Warhammer III',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Hades',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Dead Cells',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Hollow Knight',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Celeste',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Ori and the Will of the Wisps',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Dark Souls III',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Sekiro: Shadows Die Twice',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Bloodborne',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Monster Hunter: World',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Destiny 2',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                    [
                        'title' => 'Warframe',
                        'image' => 'https://via.placeholder.com/224x298',
                    ],
                ];

    // ==== FILTER BERDASARKAN KEYWORD (?q=) ====
    $keyword = trim(request('q', ''));

    $games = collect($allGames)
        ->when($keyword !== '', function ($collection) use ($keyword) {
            return $collection->filter(function ($game) use ($keyword) {
                return str_contains(strtolower($game['title']), strtolower($keyword));
            });
        })
        ->values();
@endphp

<section class="gl06">

    {{-- ================= HERO / SEARCH SECTION ================= --}}
    <div class="gl06__hero">
        <div class="gl06__hero-container">

            <h1 class="gl06__title">Discover</h1>

            <div class="gl06__subtitle-wrap">
                <p class="gl06__subtitle">
                    Discover your next favorite game from thousands of titles
                </p>
            </div>

            <form action="{{ route('games.search') ?? '#' }}" method="GET" class="gl06__search">
                <div class="gl06__search-icon">
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="2"/>
                        <path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>

                <input
                    type="text"
                    name="q"
                    class="gl06__search-input"
                    placeholder="Discover your next favorite game..."
                    value="{{ $keyword }}"
                    autocomplete="off"
                >

                <button type="submit" class="gl06__search-btn">
                    Search
                </button>
            </form>

        </div>
    </div>

    {{-- ================= RESULTS SECTION ================= --}}
    <div class="gl06__trending">

        <div class="gl06__trending-header">
            <div class="gl06__trending-heading">
                <h2 class="gl06__trending-title">Search Results</h2>
                <p class="gl06__trending-subtitle">
                    @if ($keyword !== '')
                        Menampilkan {{ $games->count() }} hasil untuk "{{ $keyword }}"
                    @else
                        Menampilkan semua game
                    @endif
                </p>
            </div>
        </div>

        @if ($games->isEmpty())
            <div class="gl06__empty">
                <p>Tidak ada game yang cocok dengan pencarian "{{ $keyword }}".</p>
            </div>
        @else
            {{-- Grid ini otomatis maksimal 5 kolom per baris (lihat .gl06__grid
                 di CSS: grid-template-columns: repeat(5, 1fr)). Card ke-6 dan
                 seterusnya otomatis lanjut ke baris baru tanpa perlu diatur manual. --}}
            <div class="gl06__grid">
                @foreach ($games as $game)
                    <article class="game-card">

                        <div class="game-card__media">
                            <img src="{{ $game['image'] }}" alt="{{ $game['title'] }}" loading="lazy">
                            <div class="game-card__media-overlay"></div>
                        </div>

                        <div class="game-card__body">
                            <h3 class="game-card__title">{{ $game['title'] }}</h3>
                        </div>

                    </article>
                @endforeach
            </div>
        @endif

    </div>

</section>
