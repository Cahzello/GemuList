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
