<?php

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

it('imports games from Steam when the local search is empty', function () {
    Http::fake([
        'store.steampowered.com/api/storesearch*' => Http::response([
            'items' => [
                ['name' => 'Cyberpunk 2077', 'id' => 1091500, 'type' => 'app', 'tiny_image' => 'https://example.com/cp2077.jpg'],
                ['name' => 'Starfield', 'id' => 1716770, 'type' => 'app', 'tiny_image' => 'https://example.com/starfield.jpg'],
                ['name' => 'Soundtrack', 'id' => 123456, 'type' => 'sub', 'tiny_image' => 'https://example.com/sub.jpg'],
            ],
        ]),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 200),
    ]);

    $this->get(route('games.search', ['q' => 'cyber']))
        ->assertOk()
        ->assertSee('Cyberpunk 2077');

    expect(Game::where('game_name', 'Cyberpunk 2077')->exists())->toBeTrue()
        ->and(Game::where('game_name', 'Cyberpunk 2077')->first()->steam_appid)->toBe(1091500)
        ->and(Game::where('game_name', 'Starfield')->exists())->toBeTrue()
        ->and(Game::where('game_name', 'Soundtrack')->exists())->toBeFalse();
});

it('merges Steam candidates with existing local matches', function () {
    Game::factory()->create(['game_name' => 'Far Cry 6', 'steam_appid' => 2369390]);

    Http::fake([
        'store.steampowered.com/api/storesearch*' => Http::response([
            'items' => [
                ['name' => 'Far Cry 6', 'id' => 2369390, 'type' => 'app', 'tiny_image' => 'https://example.com/fc6.jpg'],
                ['name' => 'Far Cry 5', 'id' => 552520, 'type' => 'app', 'tiny_image' => 'https://example.com/fc5.jpg'],
                ['name' => 'Far Cry 4', 'id' => 298110, 'type' => 'app', 'tiny_image' => 'https://example.com/fc4.jpg'],
            ],
        ]),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 200),
    ]);

    $this->get(route('games.search', ['q' => 'far cry']))
        ->assertOk()
        ->assertSee('Far Cry 6')
        ->assertSee('Far Cry 5')
        ->assertSee('Far Cry 4');

    expect(Game::where('game_name', 'like', '%far cry%')->count())->toBe(3);
});

it('does not duplicate an existing steam_appid returned under a different name', function () {
    Game::factory()->create(['game_name' => 'Call of Duty', 'steam_appid' => 1938090]);

    Http::fake([
        'store.steampowered.com/api/storesearch*' => Http::response([
            'items' => [
                ['name' => 'Call of Duty®', 'id' => 1938090, 'type' => 'app', 'tiny_image' => 'https://example.com/cod.jpg'],
            ],
        ]),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 200),
    ]);

    $this->get(route('games.search', ['q' => 'call of duty']))
        ->assertOk()
        ->assertSee('Call of Duty');

    expect(Game::where('steam_appid', 1938090)->count())->toBe(1)
        ->and(Game::where('game_name', 'Call of Duty')->exists())->toBeTrue()
        ->and(Game::where('game_name', 'Call of Duty®')->exists())->toBeFalse();
});

it('stores a Steam thumbnail URL longer than the previous column limit', function () {
    $longImage = 'https://shared.akamai.steamstatic.com/store_item_assets/steam/apps/4162040/7976c7dc75e50a5c922c04b431d6729bc86a503d/capsule_231x87_alt_assets_0.jpg?t=1785276247';

    expect(strlen($longImage))->toBe(160);

    Http::fake([
        'store.steampowered.com/api/storesearch*' => Http::response([
            'items' => [
                ['name' => 'Zenless Zone Zero', 'id' => 4162040, 'type' => 'app', 'tiny_image' => $longImage],
            ],
        ]),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 404),
    ]);

    $this->get(route('games.search', ['q' => 'zenless']))
        ->assertOk()
        ->assertSee('Zenless Zone Zero');

    expect(Game::where('game_name', 'Zenless Zone Zero')->first()->thumbnail)->toBe($longImage);
});

it('skips Steam and shows not found when the API request fails', function () {
    Http::fake([
        'store.steampowered.com/api/storesearch*' => Http::response([], 500),
    ]);

    $this->get(route('games.search', ['q' => 'nothing-matches']))
        ->assertOk()
        ->assertSee('Tidak ada game yang cocok');

    expect(Game::count())->toBe(0);
});
