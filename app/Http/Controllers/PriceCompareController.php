<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GamePrice;
use App\Services\CheapSharkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class PriceCompareController extends Controller
{
    public function __construct(private CheapSharkService $cheapshark) {}

    public function index(): View
    {
        return view('priceCompare.index');
    }

    public function search(Request $request): JsonResponse
    {
        $q = trim((string) $request->query('q', ''));

        $games = $this->gamesWithPrices($q);

        if ($q !== '' && $games->isEmpty()) {
            $this->cheapshark->pricesFor($q);
            $games = $this->gamesWithPrices($q);
        }

        return response()->json(['games' => $games->values()]);
    }

    private function gamesWithPrices(string $q): Collection
    {
        return Game::query()
            ->whereHas('gamePrices')
            ->with(['gamePrices.store'])
            ->when($q !== '', function ($query) use ($q) {
                return $query->where('game_name', 'like', "%{$q}%");
            })
            ->orderBy('game_name')
            ->get()
            ->map(fn (Game $game): array => [
                'id' => $game->id_game,
                'title' => $game->game_name,
                'thumbnail' => $game->thumbnail,
                'lowestPrice' => $game->gamePrices->min('price'),
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
            ]);
    }
}
