<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GemuList - Your Gaming Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    @vite([
        'resources/css/homepage/registrasi-gl.css',
        'resources/css/homepage/global.css',
        'resources/css/homepage/reset.css',
        'resources/css/navbar/global.css',
        'resources/css/navbar/navbar.css',
        'resources/css/navbar/reset.css',
        'resources/css/footer/global.css',
        'resources/css/footer/footer.css',
        'resources/css/footer/reset.css'
    ])
</head>

<body>
    <img src="{{ asset('assets/whats-app-img.png') }}" alt="Decorative" class="whats-app-img" />
    <div class="overlay-plus-blur"></div>

    @include('components.navbar')

    <div class="container">
        <h1 class="container-title">
            Level Up Your<br />
            <span class="sub-text">Gaming<br /></span>
            Library.
        </h1>

        <p class="container-text1">
            Daftar sekarang untuk mulai mengoleksi, memberi<br />
            rating, dan menemukan game favorit baru Anda<br />
            dalam database game tercanggih.
        </p>

        <div class="container-container1">
            <div class="container-container2">
                <button class="container-btn container-btn-bg hover-bright" title="Gaming Console">🎮</button>
                <button class="container-btn container-btn-margin1 hover-bright" title="Arcade Games">🕹️</button>
                <button class="container-btn container-btn-margin2 hover-bright" title="Video Games">💾</button>
            </div>

            <p class="container-text2">Join +10,000 gamers today</p>
        </div>
    </div>

    @include('components.footer')
</body>

</html>
