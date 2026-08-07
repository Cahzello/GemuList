<?php

use App\Models\Game;
use App\Models\GamePrice;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

beforeEach(function () {
    Cache::flush();
    Cache::put('usd_to_idr_rate', 16000, 3600);
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
        'www.cheapshark.com/api/1.0/deals*' => Http::response([
            [
                'dealID' => 'deal123',
                'title' => 'Elden Ring',
                'thumb' => 'https://example.com/elden.jpg',
                'gameID' => 236717,
                'storeID' => 1,
                'steamAppID' => 1245620,
                'salePrice' => '25.00',
                'normalPrice' => '59.99',
            ],
        ]),
    ]);

    $this->get(route('priceCompare.search', ['q' => 'Elden Ring']))
        ->assertOk()
        ->assertJsonPath('games.0.title', 'Elden Ring')
        ->assertJsonFragment(['store' => 'Steam', 'url' => 'https://www.cheapshark.com/redirect?dealID=deal123'])
        ->assertJsonFragment(['store' => 'Steam', 'price' => 400000, 'originalPrice' => 959840]);

    $game = Game::where('game_name', 'Elden Ring')->first();

    expect(GamePrice::where('id_game', $game->id_game)->where('id_store', $store->id_store)->exists())->toBeTrue();
});

it('returns multiple games with prices from a single query', function () {
    Store::factory()->create(['cheapshark_id' => 1, 'store_name' => 'Steam']);

    Http::fake([
        'www.cheapshark.com/api/1.0/deals*' => Http::response([
            ['dealID' => 'deal-fc3', 'title' => 'Far Cry 3', 'gameID' => 1, 'storeID' => 1, 'thumb' => 'https://example.com/fc3.jpg', 'salePrice' => '10.00', 'normalPrice' => '19.99'],
            ['dealID' => 'deal-fc4', 'title' => 'Far Cry 4', 'gameID' => 2, 'storeID' => 1, 'thumb' => 'https://example.com/fc4.jpg', 'salePrice' => '10.00', 'normalPrice' => '19.99'],
        ]),
    ]);

    $games = $this->get(route('priceCompare.search', ['q' => 'Far Cry']))
        ->assertOk()
        ->json('games');

    expect($games)->toHaveCount(2)
        ->and(collect($games)->pluck('title')->all())->toContain('Far Cry 3', 'Far Cry 4');

    $urls = collect($games)->flatMap(fn (array $game): array => collect($game['stores'])->pluck('url')->all());

    expect($urls)->toContain('https://www.cheapshark.com/redirect?dealID=deal-fc3')
        ->and($urls)->toContain('https://www.cheapshark.com/redirect?dealID=deal-fc4');
});

it('returns Grand Theft Auto titles when searching a broad term like grand', function () {
    Store::factory()->create(['cheapshark_id' => 1, 'store_name' => 'Steam']);

    Http::fake([
        'www.cheapshark.com/api/1.0/deals*' => Http::response([
            ['dealID' => 'deal-gta', 'title' => 'Grand Theft Auto V Enhanced', 'gameID' => 298615, 'storeID' => 1, 'thumb' => 'https://example.com/gta.jpg', 'salePrice' => '13.20', 'normalPrice' => '29.99'],
            ['dealID' => 'deal-grandages', 'title' => 'Grand Ages: Rome', 'gameID' => 921, 'storeID' => 1, 'thumb' => 'https://example.com/ga.jpg', 'salePrice' => '3.14', 'normalPrice' => '9.99'],
        ]),
    ]);

    $games = $this->get(route('priceCompare.search', ['q' => 'grand']))
        ->assertOk()
        ->json('games');

    expect(collect($games)->pluck('title')->all())->toContain('Grand Theft Auto V Enhanced', 'Grand Ages: Rome');
});

it('only makes a single deals request for a repeated query', function () {
    Store::factory()->create(['cheapshark_id' => 1, 'store_name' => 'Steam']);

    Http::fake([
        'www.cheapshark.com/api/1.0/deals*' => Http::response([
            ['dealID' => 'deal1', 'title' => 'Elden Ring', 'gameID' => 236717, 'storeID' => 1, 'thumb' => 'https://example.com/elden.jpg', 'salePrice' => '25.00', 'normalPrice' => '59.99'],
        ]),
    ]);

    $this->get(route('priceCompare.search', ['q' => 'Elden Ring']))->assertOk();
    $this->get(route('priceCompare.search', ['q' => 'Elden Ring']))->assertOk();

    Http::assertSentCount(1);

    expect(Cache::has('cheapshark.query.'.md5('elden ring')))->toBeTrue();
});

it('backfills missing deal urls for locally cached games', function () {
    $game = Game::factory()->create(['game_name' => 'Elden Ring']);
    $store = Store::factory()->create(['cheapshark_id' => 1, 'store_name' => 'Steam']);

    GamePrice::factory()->create([
        'id_game' => $game->id_game,
        'id_store' => $store->id_store,
        'price' => 400000,
        'retailPrice' => 500000,
        'dealUrl' => null,
    ]);

    Http::fake([
        'www.cheapshark.com/api/1.0/deals*' => Http::response([
            [
                'dealID' => 'backfill123',
                'title' => 'Elden Ring',
                'gameID' => 236717,
                'storeID' => 1,
                'thumb' => 'https://example.com/elden.jpg',
                'salePrice' => '25.00',
                'normalPrice' => '59.99',
            ],
        ]),
    ]);

    $this->get(route('priceCompare.search', ['q' => 'Elden']))
        ->assertOk()
        ->assertJsonFragment(['url' => 'https://www.cheapshark.com/redirect?dealID=backfill123']);

    expect(GamePrice::where('id_game', $game->id_game)->first()->dealUrl)
        ->toBe('https://www.cheapshark.com/redirect?dealID=backfill123');
});

it('does not re-fetch or re-backfill on a repeat search within the cache window', function () {
    $game = Game::factory()->create(['game_name' => 'Elden Ring']);
    $store = Store::factory()->create(['cheapshark_id' => 1, 'store_name' => 'Steam']);

    GamePrice::factory()->create([
        'id_game' => $game->id_game,
        'id_store' => $store->id_store,
        'price' => 400000,
        'retailPrice' => 500000,
        'dealUrl' => null,
    ]);

    Http::fake([
        'www.cheapshark.com/api/1.0/deals*' => Http::response([]),
    ]);

    $this->get(route('priceCompare.search', ['q' => 'Elden']))->assertOk();
    $this->get(route('priceCompare.search', ['q' => 'Elden']))->assertOk();

    Http::assertSentCount(2);
});

it('does not cache the query when the CheapShark sync fails', function () {
    Http::fake([
        'www.cheapshark.com/api/1.0/deals*' => function () {
            throw new ConnectionException('boom');
        },
    ]);

    $this->get(route('priceCompare.search', ['q' => 'Elden Ring']))->assertOk();
    $this->get(route('priceCompare.search', ['q' => 'Elden Ring']))->assertOk();

    expect(Cache::has('cheapshark.query.'.md5('elden ring')))->toBeFalse();
});
