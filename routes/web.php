<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('search.index');
})->name('search.index');

Route::get('/search', function () {
    return view('search.index');
})->name('search.index');

Route::get('/my-games', function () {
    return view('myGames.index');
})->name('myGames.index');

Route::get('/price-compare', function () {
    return view('priceCompare.index');
})->name('priceCompare.index');

Route::get('/personal-score', function () {
    return view('personalScore.index');
})->name('personalScore.index');

Route::get('/navbar', function () {
    return view('components.navbar');
})->name('games.index');

Route::get('/search', function () {
    return view('search.index');
})->name('games.search');

Route::get('/search/detail', function () {
    return view('search.detail-game');
})->name('games.detail');

Route::get('/footer', function () {
    return view('components.footer');
});

Route::get('/test', function () {
    return view('components.navbar');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');
