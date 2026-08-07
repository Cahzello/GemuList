<?php

use App\Models\Game;
use App\Models\GamePrice;
use App\Models\Store;
use App\Services\CheapSharkService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

beforeEach(function () {
    Cache::flush();
    Cache::put('usd_to_idr_rate', 16000, 3600);
});

it('syncs only the active CheapShark stores', function () {
    Http::fake([
        'www.cheapshark.com/api/1.0/stores' => Http::response([
            ['storeID' => '1', 'storeName' => 'Steam', 'isActive' => 1, 'images' => [
                'banner' => '/img/stores/banners/0.png',
                'logo' => '/img/stores/logos/0.png',
                'icon' => '/img/stores/icons/0.png',
            ]],
            ['storeID' => '4', 'storeName' => 'Amazon', 'isActive' => 0, 'images' => []],
        ]),
    ]);

    app(CheapSharkService::class)->syncStores();

    expect(Store::count())->toBe(1);

    $steam = Store::where('cheapshark_id', 1)->first();

    expect($steam->store_name)->toBe('Steam')
        ->and($steam->url)->toBe('https://store.steampowered.com')
        ->and($steam->icon)->toBe('https://www.cheapshark.com/img/stores/icons/0.png');
});

it('stores real prices converted to IDR from deals', function () {
    Store::factory()->create([
        'cheapshark_id' => 1,
        'store_name' => 'Steam',
    ]);

    Http::fake([
        'www.cheapshark.com/api/1.0/deals*' => Http::response([
            [
                'dealID' => 'abc123deal',
                'title' => 'Elden Ring',
                'thumb' => 'https://example.com/elden.jpg',
                'gameID' => 236717,
                'storeID' => 1,
                'salePrice' => '10.00',
                'normalPrice' => '59.99',
            ],
        ]),
    ]);

    app(CheapSharkService::class)->pricesFor('Elden Ring');

    $game = Game::where('game_name', 'Elden Ring')->first();

    expect($game)->not->toBeNull()
        ->and($game->thumbnail)->toBe('https://example.com/elden.jpg');

    $price = GamePrice::where('id_game', $game->id_game)->first();

    expect($price)->not->toBeNull()
        ->and((int) $price->price)->toBe(160000)
        ->and((int) $price->retailPrice)->toBe((int) round(59.99 * 16000))
        ->and($price->dealUrl)->toBe('https://www.cheapshark.com/redirect?dealID=abc123deal');
});

it('does nothing when the game is not found on CheapShark', function () {
    Http::fake([
        'www.cheapshark.com/api/1.0/deals*' => Http::response([]),
    ]);

    app(CheapSharkService::class)->pricesFor('Unknown Game');

    expect(Game::count())->toBe(0)
        ->and(GamePrice::count())->toBe(0);
});

it('stores deals with long encoded deal ids without truncating the deal url', function () {
    Store::factory()->create([
        'cheapshark_id' => 1,
        'store_name' => 'Steam',
    ]);

    $longDealId = str_repeat('A', 80);

    Http::fake([
        'www.cheapshark.com/api/1.0/deals*' => Http::response([
            ['dealID' => $longDealId, 'title' => 'Elden Ring', 'gameID' => 236717, 'storeID' => 1, 'thumb' => 'https://example.com/elden.jpg', 'salePrice' => '10.00', 'normalPrice' => '59.99'],
        ]),
    ]);

    app(CheapSharkService::class)->pricesFor('Elden Ring');

    $game = Game::where('game_name', 'Elden Ring')->first();

    expect(GamePrice::where('id_game', $game->id_game)->first()->dealUrl)
        ->toBe('https://www.cheapshark.com/redirect?dealID='.$longDealId);
});

it('stores prices for multiple games from a single deals query', function () {
    Store::factory()->create([
        'cheapshark_id' => 1,
        'store_name' => 'Steam',
    ]);

    Http::fake([
        'www.cheapshark.com/api/1.0/deals*' => Http::response([
            ['dealID' => 'deal-fc3', 'title' => 'Far Cry 3', 'gameID' => 1, 'storeID' => 1, 'thumb' => 'https://example.com/fc3.jpg', 'salePrice' => '10.00', 'normalPrice' => '19.99'],
            ['dealID' => 'deal-fc4', 'title' => 'Far Cry 4', 'gameID' => 2, 'storeID' => 1, 'thumb' => 'https://example.com/fc4.jpg', 'salePrice' => '20.00', 'normalPrice' => '29.99'],
        ]),
    ]);

    app(CheapSharkService::class)->pricesFor('Far Cry');

    expect(Game::count())->toBe(2)
        ->and(Game::where('game_name', 'Far Cry 3')->exists())->toBeTrue()
        ->and(Game::where('game_name', 'Far Cry 4')->exists())->toBeTrue();

    $fc3 = Game::where('game_name', 'Far Cry 3')->first();
    $fc4 = Game::where('game_name', 'Far Cry 4')->first();

    expect((int) GamePrice::where('id_game', $fc3->id_game)->first()->price)->toBe(160000)
        ->and((int) GamePrice::where('id_game', $fc4->id_game)->first()->price)->toBe(320000);
});
