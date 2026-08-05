<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PriceCompareController extends Controller
{
    public function index(): View
    {
        return view('priceCompare.index');
    }
}
