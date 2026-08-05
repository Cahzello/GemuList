{{--
    resources/views/search/search-results.blade.php
    Section: Search Results (Grid Style)
    Styled using Pure Tailwind CSS Utility Classes
--}}

@php
    $games = $games ?? collect();
    $keyword = $keyword ?? '';
@endphp

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
                    value="{{ $keyword }}"
                    autocomplete="off"
                >

                <button type="submit" class="shrink-0 w-full sm:w-auto h-12 sm:h-14 px-8 bg-[#FF6B35] hover:bg-[#E55A27] border-0 rounded-xl font-['Sora',sans-serif] font-semibold text-lg text-white cursor-pointer transition-colors duration-150">
                    Search
                </button>
            </form>

        </div>
    </div>

    {{-- ================= RESULTS SECTION ================= --}}
    <div class="w-full">

        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="m-0 font-['Sora',sans-serif] font-bold text-2xl leading-8 text-[#FF9F1C]">
                    Search Results
                </h2>
                <p class="mt-1 m-0 font-['Inter',sans-serif] font-normal text-base leading-6 text-[#D0D0D0]">
                    @if ($keyword !== '')
                        Showing {{ $games->count() }} results for "{{ $keyword }}"
                    @else
                        Showing all games
                    @endif
                </p>
            </div>
        </div>

        @if ($games->isEmpty())
            <div class="p-12 text-center bg-[#1E1E1E] border border-[#FF6B35]/20 rounded-xl text-[#D0D0D0] font-['Inter',sans-serif] text-base">
                <p class="m-0">Tidak ada game yang cocok dengan pencarian "{{ $keyword }}".</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-[20.8px]">
                @foreach ($games as $game)
                    <a href="{{ route('games.detail', ['title' => $game['title'], 'image' => $game['image']]) }}" class="group relative w-full aspect-[224/298] bg-[#1E1E1E] rounded-xl overflow-hidden translate-z-0 flex transition-transform duration-250 hover:-translate-y-1.5 no-underline text-inherit">

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
        @endif

    </div>

</section>
