<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Game - GemuList</title>

    {{-- Google Fonts sesuai desain Figma --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    {{-- Vite: load app.css (yang sudah @import game-search.css & search-results.css) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="margin: 0;">

    @if (trim(request('q', '')) === '')
        @include('search.game-search')
    @else
        @include('search.search-results')
    @endif

</body>
</html>