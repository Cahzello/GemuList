@extends('index')

@section('content')
    <div
        class="m-0 p-0 bg-[#141414] text-[#F4F4F4] min-h-screen relative overflow-x-hidden selection:bg-[#FF6B35] selection:text-white bg-[radial-gradient(circle_at_5%_35%,_rgba(255,107,53,0.22)_0%,_rgba(255,107,53,0)_45%),_radial-gradient(circle_at_95%_65%,_rgba(255,159,28,0.20)_0%,_rgba(255,159,28,0)_45%),_linear-gradient(180deg,_#141414_0%,_#1A1A1A_100%)] bg-fixed">
        {{-- Ambient Orange Glow Orbs --}}
        <div
            class="fixed top-[15%] -left-[120px] w-[500px] h-[500px] bg-[radial-gradient(circle,_rgba(255,107,53,0.3)_0%,_rgba(255,107,53,0)_70%)] blur-[70px] rounded-full pointer-events-none z-0">
        </div>
        <div
            class="fixed bottom-[15%] -right-[120px] w-[500px] h-[500px] bg-[radial-gradient(circle,_rgba(255,159,28,0.25)_0%,_rgba(255,159,28,0)_70%)] blur-[70px] rounded-full pointer-events-none z-0">
        </div>

        <div
            class="relative z-10 grid lg:grid-cols-2 gap-10 lg:gap-16 items-center max-w-6xl mx-auto min-h-screen pt-[95px] pb-[80px] px-6">
            <div class="text-center lg:text-left">
                <h1
                    class="font-['Sora',sans-serif] font-extrabold text-4xl sm:text-5xl lg:text-6xl leading-tight tracking-tight text-[#FF6B35]">
                    Level Up Your<br />
                    <span class="bg-gradient-to-r from-[#FF6B35] to-[#FF9F1C] bg-clip-text text-transparent">Gaming</span><br />
                    Library.
                </h1>

                <p class="mt-4 max-w-[448px] mx-auto lg:mx-0 font-['Inter',sans-serif] text-base sm:text-lg leading-relaxed text-[#D0D0D0]">
                    Sign up now to start collecting, rating, and discovering your new favorite games in the most
                    advanced game database.
                </p>

                @auth
                    <a href="{{ route('games.search') }}"
                        class="mt-10 inline-block px-8 py-3.5 rounded-full bg-[#FF6B35] text-white font-['Sora',sans-serif] font-semibold text-lg hover:bg-[#e85a26] hover:shadow-[0_0_30px_rgba(255,107,53,0.5)] transition-all duration-300">
                        Explore Games
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="mt-10 inline-block px-8 py-3.5 rounded-full bg-[#FF6B35] text-white font-['Sora',sans-serif] font-semibold text-lg hover:bg-[#e85a26] hover:shadow-[0_0_30px_rgba(255,107,53,0.5)] transition-all duration-300">
                        Sign Up
                    </a>
                @endauth
            </div>

            <div class="flex justify-center lg:justify-end">
                <img src="{{ asset('images/gemulist-product.png') }}" alt="GemuList product screenshot"
                    class="w-full max-w-xl h-auto rounded-2xl border border-[#FF6B35]/20 shadow-[0_20px_60px_rgba(255,107,53,0.25)]" />
            </div>
        </div>
    </div>
@endsection
