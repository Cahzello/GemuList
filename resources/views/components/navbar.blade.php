﻿@vite([
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
            <a href="{{ Route::has('search.index') ? route('search.index') : '#' }}" class="nav-link {{ request()->routeIs('search.*') ? 'active' : '' }}">Search Games</a>
            <a href="{{ Route::has('myGames.index') ? route('myGames.index') : '#' }}" class="nav-link {{ request()->routeIs('myGames.*') ? 'active' : '' }}">My Games</a>
            <a href="{{ Route::has('priceCompare.index') ? route('priceCompare.index') : '#' }}" class="nav-link {{ request()->routeIs('priceCompare.*') ? 'active' : '' }}">Price Compare</a>
            <a href="{{ Route::has('personalScore.index') ? route('personalScore.index') : '#' }}" class="nav-link {{ request()->routeIs('personalScore.*') ? 'active' : '' }}">Personal Score</a>
        </div>

        <div class="navbar-user">
            <div class="user-welcome">
                <p class="text2">Welcome back,</p>
                <p class="text3">Hi, {{ Auth::check() ? Auth::user()->name : 'User' }}!</p>
            </div>
        </div>
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
    });
</script>