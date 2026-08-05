<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyGamesController;
use App\Http\Controllers\PersonalScoreController;
use App\Http\Controllers\PriceCompareController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [GameController::class, 'search'])->name('games.search');
Route::get('/search/detail', [GameController::class, 'show'])->name('games.detail');

Route::get('/my-games', [MyGamesController::class, 'index'])->name('myGames.index');
Route::get('/price-compare', [PriceCompareController::class, 'index'])->name('priceCompare.index');
Route::get('/personal-score', [PersonalScoreController::class, 'index'])->name('personalScore.index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
