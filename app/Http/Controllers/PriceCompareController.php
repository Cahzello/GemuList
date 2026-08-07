<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GamePrice;
use App\Services\CheapSharkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PriceCompareController extends Controller
{
    private const QUERY_CACHE_TTL_HOURS = 6;

    private const BACKFILL_CACHE_TTL_MINUTES = 30;

    public function __construct(private CheapSharkService $cheapshark) {}

    public function index(): View
    {
        return view('priceCompare.index');
    }

    public function search(Request $request): JsonResponse
    {
        $q = trim((string) $request->query('q', ''));

        if ($q !== '') {
            $this->refreshFromCheapShark($q);
            $this->backfillMissingDealUrls($q);
        }

        return response()->json(['games' => $this->gamesWithPrices($q)->values()]);
    }

    private function refreshFromCheapShark(string $q): void
    {
        $cacheKey = 'cheapshark.query.'.md5(mb_strtolower($q));

        if (Cache::has($cacheKey)) {
            return;
        }

        try {
            $this->cheapshark->pricesFor($q);
            Cache::put($cacheKey, true, now()->addHours(self::QUERY_CACHE_TTL_HOURS));
        } catch (\Throwable $e) {
            Log::warning('CheapShark price sync failed', ['query' => $q, 'error' => $e->getMessage()]);
        }
    }

    private function backfillMissingDealUrls(string $q): void
    {
        $missingDealUrls = Game::query()
            ->whereHas('gamePrices', fn ($query) => $query->whereNull('dealUrl'))
            ->where('game_name', 'like', "%{$q}%")
            ->get()
            ->filter(fn (Game $game) => ! Cache::has($this->backfillCacheKey($game->id_game)))
            ->take(3);

        $missingDealUrls->each(function (Game $game): void {
            try {
                $this->cheapshark->backfillDealUrls($game->game_name);
            } catch (\Throwable $e) {
                Log::warning('CheapShark deal url backfill failed', ['title' => $game->game_name, 'error' => $e->getMessage()]);
            }

            Cache::put($this->backfillCacheKey($game->id_game), true, now()->addMinutes(self::BACKFILL_CACHE_TTL_MINUTES));
        });
    }

    private function backfillCacheKey(int $gameId): string
    {
        return "cheapshark.backfill.{$gameId}";
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
                        'url' => $price->dealUrl ?: $price->store->url,
                    ])
                    ->all(),
            ]);
    }
}
