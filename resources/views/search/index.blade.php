<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Game - GemuList</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    {{-- Vite: load app.css (Tailwind CSS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="m-0 p-0 bg-[#141414] text-[#F4F4F4] min-h-screen relative overflow-x-hidden selection:bg-[#FF6B35] selection:text-white bg-[radial-gradient(circle_at_5%_35%,_rgba(255,107,53,0.22)_0%,_rgba(255,107,53,0)_45%),_radial-gradient(circle_at_95%_65%,_rgba(255,159,28,0.20)_0%,_rgba(255,159,28,0)_45%),_linear-gradient(180deg,_#141414_0%,_#1A1A1A_100%)] bg-fixed">

    {{-- Ambient Orange Glow Orbs --}}
    <div class="fixed top-[15%] -left-[120px] w-[500px] h-[500px] bg-[radial-gradient(circle,_rgba(255,107,53,0.3)_0%,_rgba(255,107,53,0)_70%)] blur-[70px] rounded-full pointer-events-none z-0"></div>
    <div class="fixed bottom-[15%] -right-[120px] w-[500px] h-[500px] bg-[radial-gradient(circle,_rgba(255,159,28,0.25)_0%,_rgba(255,159,28,0)_70%)] blur-[70px] rounded-full pointer-events-none z-0"></div>

    <div class="relative z-10">
        @if (trim(request('q', '')) === '')
            @include('search.game-search')
        @else
            @include('search.search-results')
        @endif
    </div>

</body>
</html>