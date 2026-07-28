<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/my-games-gl', function () {
    return view('myGames.index');
});