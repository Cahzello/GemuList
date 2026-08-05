<?php

use App\Services\RawgService;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    config(['services.rawg.key' => 'test-key']);
});

it('maps RAWG search results to title and image', function () {
    Http::fake([
        'api.rawg.io/api/games*' => Http::response([
            'results' => [
                ['name' => 'Cyberpunk 2077', 'background_image' => 'https://example.com/cp2077.jpg'],
                ['name' => 'Elden Ring', 'background_image' => null],
                ['name' => 'Starfield', 'background_image' => 'https://example.com/starfield.jpg'],
            ],
        ]),
    ]);

    $results = app(RawgService::class)->search('cyber');

    expect($results)->toBe([
        ['title' => 'Cyberpunk 2077', 'image' => 'https://example.com/cp2077.jpg'],
        ['title' => 'Starfield', 'image' => 'https://example.com/starfield.jpg'],
    ]);
});

it('returns an empty array when the API key is missing', function () {
    config(['services.rawg.key' => '']);

    Http::fake();

    expect(app(RawgService::class)->search('cyber'))->toBe([]);
});

it('returns an empty array when the API request fails', function () {
    Http::fake([
        'api.rawg.io/api/games*' => Http::response([], 401),
    ]);

    expect(app(RawgService::class)->search('cyber'))->toBe([]);
});
