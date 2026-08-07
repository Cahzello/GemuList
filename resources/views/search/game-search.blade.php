{{--
    resources/views/search/game-search.blade.php
    Section: Hero Search + Trending Games Steam Carousel (10 AAA Games, Slide 5 Cards per Click)
    Styled using Pure Tailwind CSS Utility Classes
--}}

<section class="relative z-10 w-full max-w-[1280px] mx-auto px-6 pt-[95px] pb-[80px] box-border">

    {{-- ================= HERO / SEARCH SECTION ================= --}}
    <div class="flex justify-center mb-14">
        <div class="w-full max-w-[768px] text-center">

            <h1 class="m-0 font-['Sora',sans-serif] font-extrabold text-4xl sm:text-5xl leading-tight tracking-tight text-[#FF6B35]">
                Discover
            </h1>

            <div class="mt-4">
                <p class="m-0 font-['Inter',sans-serif] font-normal text-base sm:text-lg leading-relaxed text-[#D0D0D0]">
                    Discover your next favorite game from thousands of titles
                </p>
            </div>

            <form action="{{ route('games.search') ?? '#' }}" method="GET" class="flex flex-wrap sm:flex-nowrap items-center gap-3 w-full max-w-[768px] mx-auto mt-12 p-2 bg-[#1E1E1E] border border-[#FF6B35]/25 shadow-[0_0_30px_rgba(255,107,53,0.2)] backdrop-blur-md rounded-xl">
                <div class="shrink-0 flex items-center justify-center w-4.5 h-4.5 ml-3 text-[#A0A0A0]">
                    <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                        <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="2"/>
                        <path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>

                <input
                    type="text"
                    name="q"
                    class="flex-1 min-w-0 w-full sm:w-auto h-12 sm:h-14 px-3 bg-transparent border-0 outline-none font-['Sora',sans-serif] font-semibold text-lg text-[#F4F4F4] placeholder-[#F4F4F4]/50"
                    placeholder="Discover your next favorite game..."
                    autocomplete="off"
                >

                <button type="submit" class="shrink-0 w-full sm:w-auto h-12 sm:h-14 px-8 bg-[#FF6B35] hover:bg-[#E55A27] border-0 rounded-xl font-['Sora',sans-serif] font-semibold text-lg text-white cursor-pointer transition-colors duration-150">
                    Search
                </button>
            </form>

        </div>
    </div>

    {{-- ================= TRENDING GAMES CAROUSEL ================= --}}
    <div class="w-full">

        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="m-0 font-['Sora',sans-serif] font-bold text-2xl leading-8 text-[#FF9F1C]">
                    Trending Now
                </h2>
                <p class="mt-1 m-0 font-['Inter',sans-serif] font-normal text-base leading-6 text-[#D0D0D0]">
                    The hottest games everyone's playing
                </p>
            </div>
        </div>

        <div class="relative w-full">

            <button type="button" id="glCarouselPrev" class="absolute top-1/2 -translate-y-1/2 -left-3 sm:-left-6 z-20 w-12 h-12 bg-[#1E1E1E]/90 border border-[#FF6B35]/40 hover:border-[#FF6B35] hover:bg-[#FF6B35] hover:shadow-[0_0_15px_rgba(255,107,53,0.5)] rounded-full cursor-pointer flex items-center justify-center text-white transition-all backdrop-blur-md disabled:opacity-20 disabled:pointer-events-none" aria-label="Previous">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <button type="button" id="glCarouselNext" class="absolute top-1/2 -translate-y-1/2 -right-3 sm:-right-6 z-20 w-12 h-12 bg-[#1E1E1E]/90 border border-[#FF6B35]/40 hover:border-[#FF6B35] hover:bg-[#FF6B35] hover:shadow-[0_0_15px_rgba(255,107,53,0.5)] rounded-full cursor-pointer flex items-center justify-center text-white transition-all backdrop-blur-md disabled:opacity-20 disabled:pointer-events-none" aria-label="Next">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            @php
                $games = $trendingGames;
            @endphp

            <div id="glCarouselViewport" class="w-full overflow-hidden py-2">
                <div id="glCarouselGrid" class="flex flex-nowrap gap-5 transition-transform duration-400 ease-[cubic-bezier(0.25,1,0.5,1)]">
                    @foreach ($games as $game)
                        <a href="{{ route('games.detail', ['title' => $game['title'], 'appid' => $game['steam_appid'] ?? null, 'image' => $game['image']]) }}" class="group relative shrink-0 w-full sm:w-[calc((100%-20px)/2)] md:w-[calc((100%-40px)/3)] lg:w-[calc((100%-80px)/5)] aspect-[224/298] bg-[#1E1E1E] rounded-xl overflow-hidden translate-z-0 flex transition-transform duration-250 hover:-translate-y-1.5 no-underline text-inherit">

                            <div class="absolute inset-0 w-full h-full m-0 p-0 rounded-[inherit] overflow-hidden">
                                <img src="{{ $game['image'] }}" alt="{{ $game['title'] }}" loading="lazy" class="w-full h-full object-cover block rounded-[inherit] transition-transform duration-400 group-hover:scale-105">
                                <div class="absolute inset-0 rounded-[inherit] bg-gradient-to-t from-black/95 via-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                            </div>

                            <div class="absolute bottom-0 inset-x-0 z-20 p-4 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 pointer-events-none">
                                <h3 class="m-0 font-['Sora',sans-serif] font-bold text-base leading-5 text-white drop-shadow-md line-clamp-2">{{ $game['title'] }}</h3>
                            </div>

                        </a>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const grid = document.getElementById('glCarouselGrid');
        const prevBtn = document.getElementById('glCarouselPrev');
        const nextBtn = document.getElementById('glCarouselNext');

        if (!grid || !prevBtn || !nextBtn) return;

        let currentIndex = 0;

        function getVisibleCards() {
            if (window.innerWidth < 640) return 1;
            if (window.innerWidth < 768) return 2;
            if (window.innerWidth < 1024) return 3;
            return 5;
        }

        function updateCarousel() {
            const cards = grid.children;
            const totalCards = cards.length;
            const visible = getVisibleCards();
            const maxIndex = Math.max(0, totalCards - visible);

            if (currentIndex > maxIndex) currentIndex = maxIndex;
            if (currentIndex < 0) currentIndex = 0;

            const cardWidth = cards[0] ? cards[0].getBoundingClientRect().width : 0;
            const gap = 20; // 20px gap
            const translateX = -(currentIndex * (cardWidth + gap));

            grid.style.transform = `translateX(${translateX}px)`;

            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= maxIndex;
        }

        prevBtn.addEventListener('click', function () {
            const step = getVisibleCards();
            currentIndex = Math.max(0, currentIndex - step);
            updateCarousel();
        });

        nextBtn.addEventListener('click', function () {
            const step = getVisibleCards();
            const cards = grid.children;
            const totalCards = cards.length;
            const maxIndex = Math.max(0, totalCards - step);
            currentIndex = Math.min(maxIndex, currentIndex + step);
            updateCarousel();
        });

        window.addEventListener('resize', updateCarousel);
        updateCarousel();
    });
</script>
