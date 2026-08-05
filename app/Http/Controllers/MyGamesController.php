<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MyGamesController extends Controller
{
    public function index(): View
    {
        return view('myGames.index');
    }
}
