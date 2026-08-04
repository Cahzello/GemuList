<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('games.index');

Route::get('/search', function () {
    return view('search.index');
})->name('games.search');

Route::get('/search/detail', function () {
    return view('search.detail-game');
})->name('games.detail');
