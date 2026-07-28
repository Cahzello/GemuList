<?php

use Illuminate\Support\Facades\Route;

Route::get('/price-compare', function () {
    return view('priceCompare.index');
});
