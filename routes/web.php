<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('games.index');

Route::get('/search', function () {
    return view('search.index');
})->name('games.search');