<?php

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

beforeEach(function () {
    config(['services.rawg.key' => 'test-key']);
});

it('imports games from RAWG when the local search is empty', function () {
    Http::fake([
        'api.rawg.io/api/games*' => Http::response([
            'results' => [
                ['name' => 'Cyberpunk 2077', 'background_image' => 'https://example.com/cp2077.jpg'],
                ['name' => 'Starfield', 'background_image' => 'https://example.com/starfield.jpg'],
            ],
        ]),
    ]);

    $this->get(route('games.search', ['q' => 'cyber']))
        ->assertOk()
        ->assertSee('Cyberpunk 2077');

    expect(Game::where('game_name', 'Cyberpunk 2077')->exists())->toBeTrue()
        ->and(Game::where('game_name', 'Starfield')->exists())->toBeTrue();
});

it('does not call RAWG when the game is already stored locally', function () {
    Game::factory()->create(['game_name' => 'Cyberpunk 2077']);

    Http::fake([
        'api.rawg.io/api/games*' => Http::response([], 500),
    ]);

    $this->get(route('games.search', ['q' => 'cyber']))
        ->assertOk()
        ->assertSee('Cyberpunk 2077');
});

it('skips RAWG and shows not found when the API key is missing', function () {
    config(['services.rawg.key' => '']);

    Http::fake();

    $this->get(route('games.search', ['q' => 'nothing-matches']))
        ->assertOk()
        ->assertSee('Tidak ada game yang cocok');

    expect(Game::count())->toBe(0);
});
