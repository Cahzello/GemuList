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
Route::get('/price-compare/search', [PriceCompareController::class, 'search'])->name('priceCompare.search');

Route::middleware('auth')->group(function () {
    Route::get('/my-games', [MyGamesController::class, 'index'])->name('myGames.index');
    Route::post('/my-games', [MyGamesController::class, 'store'])->name('myGames.store');
    Route::patch('/my-games/{myGame}', [MyGamesController::class, 'update'])->name('myGames.update');
    Route::delete('/my-games/{myGame}', [MyGamesController::class, 'destroy'])->name('myGames.destroy');

    Route::get('/personal-score', [PersonalScoreController::class, 'index'])->name('personalScore.index');
    Route::post('/personal-score/{myGame}', [PersonalScoreController::class, 'update'])->name('personalScore.update');
});

require __DIR__.'/auth.php';
