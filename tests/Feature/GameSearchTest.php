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

it('does not call Steam when the game is already stored locally', function () {
    Game::factory()->create(['game_name' => 'Cyberpunk 2077']);

    Http::fake([
        'store.steampowered.com/api/storesearch*' => Http::response([], 500),
    ]);

    $this->get(route('games.search', ['q' => 'cyber']))
        ->assertOk()
        ->assertSee('Cyberpunk 2077');
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
