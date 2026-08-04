<?php

use Illuminate\Support\Facades\Route;

Route::get('/personalScore', function () {
    return view('personalScore.index');
});
