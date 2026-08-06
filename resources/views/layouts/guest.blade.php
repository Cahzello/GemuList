<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GemuList</title>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sora:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-background overflow-auto">
    <div class="relative min-h-screen flex flex-col items-center justify-center p-6 sm:p-12 overflow-hidden">
        <!-- Decorative blur overlays -->
        <div class="absolute top-1/5 -left-20 w-96 h-96 bg-secondary rounded-lg blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -right-20 w-96 h-96 bg-secondary rounded-lg blur-3xl pointer-events-none"></div>

        <!-- Auth Card -->
        <div class="relative z-10 w-full max-w-md">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
