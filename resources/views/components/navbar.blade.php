@vite([
    "resources/css/navbar/global.css",
    "resources/css/navbar/navbar.css",
    "resources/css/navbar/reset.css",
])

<nav class="navbar-container">
    <div class="navbar-content">
        <div class="navbar-logo">
            <h1 class="title-left">GL</h1>
        </div>

        <div class="navbar-links">
            <a href="{{ Route::has('search.index') ? route('search.index') : '#' }}" class="nav-link">Search Games</a>
            <a href="{{ Route::has('myGames.index') ? route('myGames.index') : '#' }}" class="nav-link">My Games</a>
            <a href="{{ Route::has('priceCompare.index') ? route('priceCompare.index') : '#' }}" class="nav-link">Price Compare</a>
            <a href="#" class="nav-link nav-link--light">Personal Score</a>
        </div>

        <div class="navbar-user">
            <div class="user-welcome">
                <p class="text2">Welcome back,</p>
                <p class="text3">Hi, {{ Auth::check() ? Auth::user()->name : 'User' }}!</p>
            </div>

            <div class="circle-right">
                <img src="{{ asset('assets/icon.png') }}" alt="User Icon" class="icon" />
            </div>
        </div>

        <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle navigation">
            <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ Route::has('search.index') ? route('search.index') : '#' }}" class="mobile-nav-link">Search Games</a>
        <a href="{{ Route::has('myGames.index') ? route('myGames.index') : '#' }}" class="mobile-nav-link">My Games</a>
        <a href="{{ Route::has('priceCompare.index') ? route('priceCompare.index') : '#' }}" class="mobile-nav-link">Price Compare</a>
        <a href="#" class="mobile-nav-link">Personal Score</a>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenuBtn?.addEventListener('click', () => mobileMenu?.classList.toggle('active'));
    });
</script>
