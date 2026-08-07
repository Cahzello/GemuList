<?php

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

it('fetches the description from Steam when the game has a steam_appid', function () {
    Game::factory()->create(['game_name' => 'Elden Ring', 'steam_appid' => 1245620]);

    Http::fake([
        'store.steampowered.com/api/appdetails*' => Http::response([
            '1245620' => [
                'success' => true,
                'data' => [
                    'name' => 'Elden Ring',
                    'detailed_description' => '<p>THE GOLDEN ORDER has been broken.</p>',
                ],
            ],
        ]),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 200),
    ]);

    $this->get(route('games.detail', ['title' => 'Elden Ring', 'image' => 'https://example.com/elden.jpg']))
        ->assertOk()
        ->assertSee('THE GOLDEN ORDER has been broken.');
});

it('falls back to the stored description when Steam has no data', function () {
    Game::factory()->create(['game_name' => 'Elden Ring', 'steam_appid' => null]);

    Http::fake([
        'store.steampowered.com/api/appdetails*' => Http::response([], 500),
    ]);

    $this->get(route('games.detail', ['title' => 'Elden Ring', 'image' => 'https://example.com/elden.jpg']))
        ->assertOk()
        ->assertSee('Rise, Tarnished, and be guided by grace');
});

it('clamps the description with an ellipsis when it is too long', function () {
    Game::factory()->create(['game_name' => 'Elden Ring', 'steam_appid' => null]);

    $this->get(route('games.detail', ['title' => 'Elden Ring', 'image' => 'https://example.com/elden.jpg']))
        ->assertOk()
        ->assertSee('line-clamp-6')
        ->assertDontSee('Baca Selengkapnya')
        ->assertDontSee('descToggleBtn');
});

it('imports a game from Steam and enables the add button when it is not in the database', function () {
    Http::fake([
        'store.steampowered.com/api/storesearch*' => Http::response([
            'items' => [
                ['name' => 'Elden Ring', 'id' => 1245620, 'type' => 'app', 'tiny_image' => 'https://example.com/elden.jpg'],
            ],
        ]),
        'store.steampowered.com/api/appdetails*' => Http::response([], 500),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 200),
    ]);

    $this->get(route('games.detail', ['title' => 'Elden Ring', 'image' => 'https://example.com/elden.jpg']))
        ->assertOk()
        ->assertSee('Add to My Games')
        ->assertDontSee('disabled aria-disabled="true"');

    expect(Game::where('game_name', 'Elden Ring')->exists())->toBeTrue()
        ->and(Game::where('game_name', 'Elden Ring')->first()->steam_appid)->toBe(1245620);
});

it('keeps the add button disabled when the game cannot be found on Steam', function () {
    Http::fake([
        'store.steampowered.com/api/storesearch*' => Http::response(['items' => []]),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 200),
    ]);

    $this->get(route('games.detail', ['title' => 'Nonexistent Game', 'image' => 'https://example.com/nope.jpg']))
        ->assertOk();

    expect(Game::count())->toBe(0);
});
