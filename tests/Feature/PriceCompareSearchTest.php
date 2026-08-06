<?php

use App\Models\Game;
use App\Models\GamePrice;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

beforeEach(function () {
    Cache::flush();
});

it('returns locally cached games with prices', function () {
    $game = Game::factory()->create(['game_name' => 'Elden Ring']);
    $store = Store::factory()->create(['cheapshark_id' => 1, 'store_name' => 'Steam']);

    GamePrice::factory()->create([
        'id_game' => $game->id_game,
        'id_store' => $store->id_store,
        'price' => 400000,
        'retailPrice' => 500000,
    ]);

    Http::fake();

    $this->get(route('priceCompare.search', ['q' => 'Elden']))
        ->assertOk()
        ->assertJsonFragment([
            'title' => 'Elden Ring',
            'lowestPrice' => 400000,
        ])
        ->assertJsonFragment(['store' => 'Steam', 'price' => 400000, 'originalPrice' => 500000]);
});

it('fetches and caches prices from CheapShark when no local prices exist', function () {
    $store = Store::factory()->create(['cheapshark_id' => 1, 'store_name' => 'Steam']);

    Http::fake([
        'www.cheapshark.com/api/1.0/games*' => Http::response([
            ['external' => 'Elden Ring', 'thumb' => 'https://example.com/elden.jpg'],
        ]),
        'www.cheapshark.com/api/1.0/deals*' => Http::response([
            [
                'dealID' => 'deal123',
                'external' => 'Elden Ring',
                'title' => 'Elden Ring',
                'storeID' => 1,
                'salePrice' => '25.00',
                'normalPrice' => '59.99',
            ],
        ]),
        'open.er-api.com/*' => Http::response([
            'result' => 'success',
            'rates' => ['IDR' => 16000],
        ]),
    ]);

    $this->get(route('priceCompare.search', ['q' => 'Elden Ring']))
        ->assertOk()
        ->assertJsonPath('games.0.title', 'Elden Ring')
        ->assertJsonFragment(['store' => 'Steam', 'url' => 'https://www.cheapshark.com/redirect?dealID=deal123']);

    $game = Game::where('game_name', 'Elden Ring')->first();

    expect(GamePrice::where('id_game', $game->id_game)->where('id_store', $store->id_store)->exists())->toBeTrue();
});

it('returns multiple games with prices from a single query', function () {
    $store = Store::factory()->create(['cheapshark_id' => 1, 'store_name' => 'Steam']);

    Http::fake([
        'www.cheapshark.com/api/1.0/games*' => Http::response([
            ['external' => 'Far Cry 3', 'thumb' => 'https://example.com/fc3.jpg'],
            ['external' => 'Far Cry 4', 'thumb' => 'https://example.com/fc4.jpg'],
        ]),
        'www.cheapshark.com/api/1.0/deals*' => function ($request) {
            $title = $request->data()['title'] ?? '';

            return Http::response([
                ['dealID' => 'deal-'.$title, 'external' => $title, 'title' => $title, 'storeID' => 1, 'salePrice' => '10.00', 'normalPrice' => '19.99'],
            ]);
        },
        'open.er-api.com/*' => Http::response([
            'result' => 'success',
            'rates' => ['IDR' => 16000],
        ]),
    ]);

    $games = $this->get(route('priceCompare.search', ['q' => 'Far Cry']))
        ->assertOk()
        ->json('games');

    expect($games)->toHaveCount(2)
        ->and(collect($games)->pluck('title')->all())->toContain('Far Cry 3', 'Far Cry 4');

    $urls = collect($games)->flatMap(fn (array $game): array => collect($game['stores'])->pluck('url')->all());

    expect($urls)->toContain('https://www.cheapshark.com/redirect?dealID=deal-Far Cry 3')
        ->and($urls)->toContain('https://www.cheapshark.com/redirect?dealID=deal-Far Cry 4');
});
