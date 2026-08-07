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

it('resolves the game by its unique steam_appid when the title differs', function () {
    $existing = Game::factory()->create(['game_name' => 'Grand Theft Auto V Enhanced', 'steam_appid' => 3240220]);

    Http::fake([
        'store.steampowered.com/api/appdetails*' => Http::response([], 500),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 200),
    ]);

    $this->get(route('games.detail', ['title' => 'Grand Theft Auto V', 'appid' => 3240220, 'image' => 'https://example.com/gta.jpg']))
        ->assertOk()
        ->assertSee('Add to My Games')
        ->assertDontSee('disabled aria-disabled="true"')
        ->assertSee('const gameId = '.$existing->id_game.';');

    expect(Game::count())->toBe(1)
        ->and(Game::where('steam_appid', 3240220)->first()->game_name)->toBe('Grand Theft Auto V Enhanced');
});

it('imports a game by its steam_appid when it is not in the database', function () {
    Http::fake([
        'store.steampowered.com/api/appdetails*' => Http::response([
            '1888930' => [
                'success' => true,
                'data' => [
                    'name' => 'The Last of Us Part I',
                    'detailed_description' => '<p>Experience the game.</p>',
                    'header_image' => 'https://example.com/tlou.jpg',
                ],
            ],
        ]),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 200),
    ]);

    $this->get(route('games.detail', ['title' => 'The Last of Us Part I', 'appid' => 1888930, 'image' => 'https://example.com/tlou.jpg']))
        ->assertOk()
        ->assertSee('Add to My Games')
        ->assertDontSee('disabled aria-disabled="true"');

    expect(Game::where('steam_appid', 1888930)->exists())->toBeTrue()
        ->and(Game::where('steam_appid', 1888930)->first()->game_name)->toBe('The Last of Us Part I');
});
