@extends('index')

@section('content')
    <div class="m-0 p-0 bg-[#141414] text-[#F4F4F4] min-h-screen relative overflow-x-hidden selection:bg-[#FF6B35] selection:text-white bg-[radial-gradient(circle_at_5%_35%,_rgba(255,107,53,0.22)_0%,_rgba(255,107,53,0)_45%),_radial-gradient(circle_at_95%_65%,_rgba(255,159,28,0.20)_0%,_rgba(255,159,28,0)_45%),_linear-gradient(180deg,_#141414_0%,_#1A1A1A_100%)] bg-fixed">
        {{-- Ambient Orange Glow Orbs --}}
        <div class="fixed top-[15%] -left-[120px] w-[500px] h-[500px] bg-[radial-gradient(circle,_rgba(255,107,53,0.3)_0%,_rgba(255,107,53,0)_70%)] blur-[70px] rounded-full pointer-events-none z-0"></div>
        <div class="fixed bottom-[15%] -right-[120px] w-[500px] h-[500px] bg-[radial-gradient(circle,_rgba(255,159,28,0.25)_0%,_rgba(255,159,28,0)_70%)] blur-[70px] rounded-full pointer-events-none z-0"></div>

        <div class="relative z-10 flex flex-col items-center justify-center min-h-screen pt-[95px] pb-[80px] px-6 text-center">
            <h1 class="font-['Sora',sans-serif] font-extrabold text-4xl sm:text-5xl lg:text-6xl leading-tight tracking-tight text-[#FF6B35]">
                Level Up Your<br />
                <span class="bg-gradient-to-r from-[#FF6B35] to-[#FF9F1C] bg-clip-text text-transparent">Gaming</span><br />
                Library.
            </h1>

            <p class="mt-4 max-w-[448px] font-['Inter',sans-serif] text-base sm:text-lg leading-relaxed text-[#D0D0D0]">
                Daftar sekarang untuk mulai mengoleksi, memberi<br class="hidden sm:block" />
                rating, dan menemukan game favorit baru Anda<br class="hidden sm:block" />
                dalam database game tercanggih.
            </p>

            <div class="mt-10 flex items-center flex-wrap justify-center gap-4">
                <div class="flex items-center">
                    <button type="button" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border-2 border-[#FF6B35]/60 bg-[#1E1E1E] hover:bg-[#FF6B35]/20 hover:scale-110 transition-all duration-300 flex items-center justify-center text-lg sm:text-xl cursor-pointer" title="Gaming Console">🎮</button>
                    <button type="button" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border-2 border-[#FF6B35]/60 bg-[#1E1E1E] hover:bg-[#FF6B35]/20 hover:scale-110 transition-all duration-300 flex items-center justify-center text-lg sm:text-xl cursor-pointer -ml-2 z-10" title="Arcade Games">🕹️</button>
                    <button type="button" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border-2 border-[#FF6B35]/60 bg-[#1E1E1E] hover:bg-[#FF6B35]/20 hover:scale-110 transition-all duration-300 flex items-center justify-center text-lg sm:text-xl cursor-pointer -ml-2 z-20" title="Video Games">💾</button>
                </div>

                <p class="font-['Inter',sans-serif] text-sm text-[#A0A0A0]">Join +10,000 gamers today</p>
            </div>
        </div>
    </div>
@endsection
