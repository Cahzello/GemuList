<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GamePrice;
use Illuminate\View\View;

class PriceCompareController extends Controller
{
    public function index(): View
    {
        $games = Game::query()
            ->whereHas('gamePrices')
            ->with(['gamePrices.store'])
            ->orderBy('game_name')
            ->get()
            ->map(fn (Game $game): array => [
                'id' => $game->id_game,
                'title' => $game->game_name,
                'thumbnail' => $game->thumbnail,
                'stores' => $game->gamePrices
                    ->sortBy(fn (GamePrice $price) => $price->store->store_name)
                    ->values()
                    ->map(fn (GamePrice $price): array => [
                        'store' => $price->store->store_name,
                        'icon' => $price->store->icon,
                        'price' => (int) $price->price,
                        'originalPrice' => (int) $price->retailPrice,
                        'url' => $price->store->url,
                    ])
                    ->all(),
            ])
            ->values();

        return view('priceCompare.index', ['games' => $games]);
    }
}
