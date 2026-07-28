{{--
    resources/views/search/game-search.blade.php
    Section: Hero Search + Trending Games Steam Carousel (GL06)
    CSS: resources/css/game-search.css
--}}

<section class="gl06 gl06--carousel">

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
                    autocomplete="off"
                >

                <button type="submit" class="gl06__search-btn">
                    Search
                </button>
            </form>

        </div>
    </div>

    {{-- ================= TRENDING GAMES CAROUSEL ================= --}}
    <div class="gl06__trending">

        <div class="gl06__trending-header">
            <div class="gl06__trending-heading">
                <h2 class="gl06__trending-title">Trending Now</h2>
                <p class="gl06__trending-subtitle">The hottest games everyone's playing</p>
            </div>
        </div>

        <div class="gl06__carousel-wrapper">

            <button type="button" class="gl06__nav-btn gl06__nav-btn--prev" aria-label="Previous">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <button type="button" class="gl06__nav-btn gl06__nav-btn--next" aria-label="Next">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            @php
                $games = [
                    ['title' => 'Cyberpunk 2077', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'Elden Ring', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => "Baldur's Gate 3", 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'Valorant', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'Starfield', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'Red Dead Redemption 2', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'The Witcher 3', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'God of War Ragnarök', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'Hogwarts Legacy', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'Call of Duty: Modern Warfare', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'Diablo IV', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'Final Fantasy XVI', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'Resident Evil 4', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'Street Fighter 6', 'image' => 'https://via.placeholder.com/224x298'],
                    ['title' => 'Mortal Kombat 1', 'image' => 'https://via.placeholder.com/224x298'],
                ];
            @endphp

            <div class="gl06__grid-viewport">
                <div class="gl06__grid">
                    @foreach ($games as $game)
                        <article class="carousel-card">

                            <div class="carousel-card__media">
                                <img src="{{ $game['image'] }}" alt="{{ $game['title'] }}" loading="lazy">
                                <div class="carousel-card__media-overlay"></div>
                            </div>

                            <div class="carousel-card__body">
                                <h3 class="carousel-card__title">{{ $game['title'] }}</h3>
                            </div>

                        </article>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

</section>
