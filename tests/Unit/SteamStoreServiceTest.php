<?php

use App\Services\SteamStoreService;
use Illuminate\Support\Facades\Http;

it('maps Steam search results to title, image and steam_appid', function () {
    Http::fake([
        'store.steampowered.com/api/storesearch*' => Http::response([
            'items' => [
                ['name' => 'Cyberpunk 2077', 'id' => 1091500, 'type' => 'app', 'tiny_image' => 'https://example.com/cp2077.jpg'],
                ['name' => 'Soundtrack', 'id' => 123456, 'type' => 'sub', 'tiny_image' => 'https://example.com/sub.jpg'],
                ['name' => 'Elden Ring', 'id' => 1245620, 'type' => 'app', 'tiny_image' => null],
            ],
        ]),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 200),
    ]);

    $results = app(SteamStoreService::class)->search('cyber');

    expect($results)->toBe([
        [
            'title' => 'Cyberpunk 2077',
            'image' => 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1091500/library_600x900.jpg',
            'steam_appid' => 1091500,
        ],
        [
            'title' => 'Elden Ring',
            'image' => 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1245620/library_600x900.jpg',
            'steam_appid' => 1245620,
        ],
    ]);
});

it('falls back to the tiny image when the portrait cover does not exist', function () {
    Http::fake([
        'store.steampowered.com/api/storesearch*' => Http::response([
            'items' => [
                ['name' => 'Cyberpunk 2077', 'id' => 1091500, 'type' => 'app', 'tiny_image' => 'https://example.com/cp2077.jpg'],
            ],
        ]),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 404),
    ]);

    $results = app(SteamStoreService::class)->search('cyber');

    expect($results[0]['image'])->toBe('https://example.com/cp2077.jpg');
});

it('returns an empty array when the API request fails', function () {
    Http::fake([
        'store.steampowered.com/api/storesearch*' => Http::response([], 401),
    ]);

    expect(app(SteamStoreService::class)->search('cyber'))->toBe([]);
});

it('maps app details to a sanitized description', function () {
    Http::fake([
        'store.steampowered.com/api/appdetails*' => Http::response([
            '1245620' => [
                'success' => true,
                'data' => [
                    'name' => 'Elden Ring',
                    'detailed_description' => '<p>THE GOLDEN ORDER<br/>has been broken.</p>',
                    'header_image' => 'https://example.com/header.jpg',
                    'release_date' => ['date' => '24 Feb, 2022'],
                    'genres' => [['id' => 1, 'description' => 'RPG'], ['id' => 2, 'description' => 'Action']],
                ],
            ],
        ]),
        'shared.fastly.steamstatic.com/*' => Http::response(null, 200),
    ]);

    $detail = app(SteamStoreService::class)->detail(1245620);

    expect($detail)->toMatchArray([
        'title' => 'Elden Ring',
        'description' => 'THE GOLDEN ORDER has been broken.',
        'releaseDate' => '24 Feb, 2022',
        'genres' => ['RPG', 'Action'],
    ]);
});

it('returns null when the app is not found', function () {
    Http::fake([
        'store.steampowered.com/api/appdetails*' => Http::response([
            '999999' => ['success' => false],
        ]),
    ]);

    expect(app(SteamStoreService::class)->detail(999999))->toBeNull();
});

it('returns null when the detail request fails', function () {
    Http::fake([
        'store.steampowered.com/api/appdetails*' => Http::response([], 500),
    ]);

    expect(app(SteamStoreService::class)->detail(1245620))->toBeNull();
});
