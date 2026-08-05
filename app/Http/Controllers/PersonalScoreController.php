<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PersonalScoreController extends Controller
{
    public function index(): View
    {
        return view('personalScore.index');
    }
}
