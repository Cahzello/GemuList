<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyGamesController;
use App\Http\Controllers\PersonalScoreController;
use App\Http\Controllers\PriceCompareController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [GameController::class, 'search'])->name('games.search');
Route::get('/search/detail', [GameController::class, 'show'])->name('games.detail');

Route::get('/price-compare', [PriceCompareController::class, 'index'])->name('priceCompare.index');

Route::middleware('auth')->group(function () {
    Route::get('/my-games', [MyGamesController::class, 'index'])->name('myGames.index');
    Route::get('/personal-score', [PersonalScoreController::class, 'index'])->name('personalScore.index');
});

require __DIR__.'/auth.php';
