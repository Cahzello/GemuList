<?php

namespace App\Services;

use App\Models\Game;
use App\Models\GamePrice;
use App\Models\Store;
use Illuminate\Http\Client\PendingRequest;
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

    public function pricesFor(string $title): void
    {
        try {
            $gameMatch = $this->findGame($title);

            if ($gameMatch === null) {
                return;
            }

            $game = Game::updateOrCreate(
                ['game_name' => $gameMatch['external']],
                ['thumbnail' => $gameMatch['thumb'] ?? ''],
            );

            $rate = $this->exchangeRate->idr();

            collect($this->dealsFor($gameMatch['external']))
                ->each(function (array $deal) use ($game, $rate): void {
                    $store = Store::where('cheapshark_id', (int) ($deal['storeID'] ?? 0))->first();

                    if ($store === null) {
                        $this->syncStores();
                        $store = Store::where('cheapshark_id', (int) ($deal['storeID'] ?? 0))->first();
                    }

                    if ($store === null) {
                        return;
                    }

                    GamePrice::updateOrCreate(
                        ['id_game' => $game->id_game, 'id_store' => $store->id_store],
                        [
                            'price' => round((float) ($deal['salePrice'] ?? 0) * $rate),
                            'retailPrice' => round((float) ($deal['normalPrice'] ?? 0) * $rate),
                        ],
                    );
                });
        } catch (\Throwable $e) {
            Log::warning('CheapShark price sync failed', ['title' => $title, 'error' => $e->getMessage()]);
        }
    }

    /**
     * @return array{external: string, thumb: string}|null
     */
    private function findGame(string $title): ?array
    {
        $response = $this->client()->get(config('services.cheapshark.url').'/games', ['title' => $title]);

        if ($response->failed()) {
            Log::warning('CheapShark game lookup failed', ['title' => $title, 'status' => $response->status()]);

            return null;
        }

        $matches = collect($response->json());

        if ($matches->isEmpty()) {
            return null;
        }

        $exact = $matches->firstWhere(fn (array $match): bool => strtolower((string) $match['external']) === strtolower($title));
        $match = $exact ?? $matches->first();

        return [
            'external' => (string) ($match['external'] ?? ''),
            'thumb' => (string) ($match['thumb'] ?? ''),
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function dealsFor(string $title): array
    {
        $response = $this->client()->get(config('services.cheapshark.url').'/deals', ['title' => $title]);

        if ($response->failed()) {
            Log::warning('CheapShark deals request failed', ['title' => $title, 'status' => $response->status()]);

            return [];
        }

        $deals = collect($response->json());

        if ($deals->isEmpty()) {
            return [];
        }

        $matching = $deals->filter(function (array $deal) use ($title): bool {
            return strtolower((string) ($deal['external'] ?? $deal['internalName'] ?? '')) === strtolower($title);
        });

        return $matching->isNotEmpty() ? $matching->values()->all() : $deals->values()->all();
    }

    private function absoluteImage(?string $path): string
    {
        if ($path === null || $path === '') {
            return '';
        }

        return str_starts_with($path, 'http') ? $path : 'https://www.cheapshark.com'.$path;
    }
}
