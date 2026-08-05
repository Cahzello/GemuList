@vite([
    "resources/css/navbar/global.css",
    "resources/css/navbar/navbar.css",
])

<nav class="navbar-container">
    <div class="navbar-content">
        <div class="navbar-logo">
            <h1 class="title-left">GL</h1>
        </div>

        <div class="navbar-links">
            <a href="{{ Route::has('search.index') ? route('search.index') : '#' }}" class="nav-link {{ request()->routeIs('search.*') ? 'active' : '' }}">Search Games</a>
            <a href="{{ Route::has('myGames.index') ? route('myGames.index') : '#' }}" class="nav-link {{ request()->routeIs('myGames.*') ? 'active' : '' }}">My Games</a>
            <a href="{{ Route::has('priceCompare.index') ? route('priceCompare.index') : '#' }}" class="nav-link {{ request()->routeIs('priceCompare.*') ? 'active' : '' }}">Price Compare</a>
            <a href="{{ Route::has('personalScore.index') ? route('personalScore.index') : '#' }}" class="nav-link {{ request()->routeIs('personalScore.*') ? 'active' : '' }}">Personal Score</a>
        </div>

        <div class="navbar-user">
            <div class="user-welcome" id="userDropdownToggle">
                <p class="text2">Welcome back,</p>
                <p class="text3">Hi, {{ Auth::check() ? Auth::user()->name : 'User' }}!</p>
            </div>
            <div class="user-dropdown" id="userDropdown">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ Route::has('search.index') ? route('search.index') : '#' }}" class="mobile-nav-link {{ request()->routeIs('search.*') ? 'active' : '' }}">Search Games</a>
        <a href="{{ Route::has('myGames.index') ? route('myGames.index') : '#' }}" class="mobile-nav-link {{ request()->routeIs('myGames.*') ? 'active' : '' }}">My Games</a>
        <a href="{{ Route::has('priceCompare.index') ? route('priceCompare.index') : '#' }}" class="mobile-nav-link {{ request()->routeIs('priceCompare.*') ? 'active' : '' }}">Price Compare</a>
        <a href="{{ Route::has('personalScore.index') ? route('personalScore.index') : '#' }}" class="mobile-nav-link {{ request()->routeIs('personalScore.*') ? 'active' : '' }}">Personal Score</a>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenuBtn?.addEventListener('click', () => mobileMenu?.classList.toggle('active'));

        // User dropdown toggle
        const userToggle = document.getElementById('userDropdownToggle');
        const userDropdown = document.getElementById('userDropdown');
        
        userToggle?.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown?.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userToggle?.contains(e.target) && !userDropdown?.contains(e.target)) {
                userDropdown?.classList.remove('active');
            }
        });
    });
</script>
