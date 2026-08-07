<?php

namespace App\Services;

use App\Models\Game;
use App\Models\GamePrice;
use App\Models\Store;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheapSharkService
{
    public const STORE_HOMEPAGES = [
        'Steam' => 'https://store.steampowered.com',
        'GamersGate' => 'https://www.gamersgate.com',
        'GreenManGaming' => 'https://www.greenmangaming.com',
        'GOG' => 'https://www.gog.com',
        'Humble Store' => 'https://www.humblebundle.com/store',
        'Uplay' => 'https://store.ubi.com',
        'Fanatical' => 'https://www.fanatical.com',
        'WinGameStore' => 'https://www.wingamestore.com',
        'GameBillet' => 'https://www.gamebillet.com',
        'Epic Games Store' => 'https://store.epicgames.com',
        'Gamesplanet' => 'https://uk.gamesplanet.com',
        'Gamesload' => 'https://www.gamesload.de',
        'IndieGala' => 'https://www.indiegala.com',
        'DreamGame' => 'https://www.dreamgame.com',
    ];

    public function __construct(private ExchangeRateService $exchangeRate) {}

    private function client(): PendingRequest
    {
        return Http::timeout(10)->withHeaders([
            'User-Agent' => 'GemuList/1.0 (https://github.com/Cahzello/GemuList)',
        ]);
    }

    public function syncStores(): void
    {
        $response = $this->client()->get(config('services.cheapshark.url').'/stores');

        if ($response->failed()) {
            Log::warning('CheapShark store list failed', ['status' => $response->status()]);

            return;
        }

        collect($response->json())
            ->filter(fn (array $store): bool => (bool) $store['isActive'])
            ->each(function (array $store): void {
                $homepage = self::STORE_HOMEPAGES[$store['storeName']] ?? 'https://www.cheapshark.com';
                Store::updateOrCreate(
                    ['cheapshark_id' => (int) $store['storeID']],
                    [
                        'store_name' => $store['storeName'],
                        'banner' => $this->absoluteImage($store['images']['banner'] ?? null),
                        'logo' => $this->absoluteImage($store['images']['logo'] ?? null),
                        'icon' => $this->absoluteImage($store['images']['icon'] ?? null),
                        'url' => $homepage,
                    ],
                );
            });
    }

    /**
     * Fetch deals for a fuzzy title query in a single request and persist games and prices.
     */
    public function pricesFor(string $query): void
    {
        $rate = $this->exchangeRate->idr();

        $this->groupedDeals($query)->each(function (Collection $deals) use ($rate): void {
            try {
                $this->persistGroup($deals, $rate);
            } catch (\Throwable $e) {
                Log::warning('CheapShark price group failed', ['error' => $e->getMessage()]);
            }
        });
    }

    /**
     * @param  Collection<int, array<string, mixed>>  $deals
     */
    private function persistGroup(Collection $deals, float $rate): void
    {
        $first = $deals->first();

        if (! is_array($first) || (string) ($first['title'] ?? '') === '') {
            return;
        }

        $game = $this->resolveGame($first);
        $thumbnail = $this->validThumb($first['thumb'] ?? null);

        if ($thumbnail !== '' && $thumbnail !== $game->thumbnail) {
            $game->update(['thumbnail' => $thumbnail]);
        }

        foreach ($deals as $deal) {
            try {
                $store = $this->resolveStore($deal);

                if ($store === null) {
                    continue;
                }

                GamePrice::updateOrCreate(
                    ['id_game' => $game->id_game, 'id_store' => $store->id_store],
                    [
                        'price' => round((float) ($deal['salePrice'] ?? 0) * $rate),
                        'retailPrice' => round((float) ($deal['normalPrice'] ?? 0) * $rate),
                        'dealUrl' => isset($deal['dealID'])
                            ? 'https://www.cheapshark.com/redirect?dealID='.$deal['dealID']
                            : null,
                    ],
                );
            } catch (\Throwable $e) {
                Log::warning('CheapShark price deal failed', ['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Fill in missing deal URLs for existing price rows of an exact title match.
     */
    public function backfillDealUrls(string $title): void
    {
        $game = Game::where('game_name', $title)->first();

        if ($game === null) {
            return;
        }

        $matching = collect($this->dealsForQuery($title))
            ->filter(fn (array $deal): bool => strtolower((string) ($deal['title'] ?? '')) === strtolower($title));

        foreach ($matching as $deal) {
            $store = Store::where('cheapshark_id', (int) ($deal['storeID'] ?? 0))->first();

            if ($store === null || ! isset($deal['dealID'])) {
                continue;
            }

            GamePrice::where('id_game', $game->id_game)
                ->where('id_store', $store->id_store)
                ->update(['dealUrl' => 'https://www.cheapshark.com/redirect?dealID='.$deal['dealID']]);
        }
    }

    /**
     * @return Collection<string, Collection<int, array<string, mixed>>>
     */
    private function groupedDeals(string $query): Collection
    {
        return collect($this->dealsForQuery($query))
            ->groupBy(function (array $deal): string {
                $gameId = (int) ($deal['gameID'] ?? 0);

                return $gameId !== 0 ? (string) $gameId : mb_strtolower(trim((string) ($deal['title'] ?? '')));
            });
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function dealsForQuery(string $query): array
    {
        $response = $this->client()->get(config('services.cheapshark.url').'/deals', ['title' => $query]);

        if ($response->failed()) {
            Log::warning('CheapShark deals request failed', ['title' => $query, 'status' => $response->status()]);

            return [];
        }

        return collect($response->json())
            ->filter(fn (array $deal): bool => (string) ($deal['title'] ?? '') !== '')
            ->values()
            ->all();
    }

    private function resolveGame(array $deal): Game
    {
        $appId = isset($deal['steamAppID']) ? (int) $deal['steamAppID'] : null;

        if ($appId !== null) {
            $existing = Game::where('steam_appid', $appId)->first();

            if ($existing !== null) {
                return $existing;
            }
        }

        return Game::firstOrCreate(
            ['game_name' => mb_substr((string) $deal['title'], 0, 100)],
            ['thumbnail' => $this->validThumb($deal['thumb'] ?? null)],
        );
    }

    private function resolveStore(array $deal): ?Store
    {
        $storeId = (int) ($deal['storeID'] ?? 0);
        $store = Store::where('cheapshark_id', $storeId)->first();

        if ($store === null) {
            $this->syncStores();
            $store = Store::where('cheapshark_id', $storeId)->first();
        }

        return $store;
    }

    private function validThumb(mixed $thumb): string
    {
        $thumb = is_string($thumb) ? trim($thumb) : '';

        return $thumb !== '' && mb_strtolower($thumb) !== 'none' ? $thumb : '';
    }

    private function absoluteImage(?string $path): string
    {
        if ($path === null || $path === '') {
            return '';
        }

        return str_starts_with($path, 'http') ? $path : 'https://www.cheapshark.com'.$path;
    }
}
