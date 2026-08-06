<?php

use App\Services\ExchangeRateService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Cache::flush();
});

it('returns the IDR rate from the er-api response', function () {
    Http::fake([
        'open.er-api.com/*' => Http::response([
            'result' => 'success',
            'rates' => ['IDR' => 16250],
        ]),
    ]);

    $rate = app(ExchangeRateService::class)->idr();

    expect($rate)->toBe(16250.0);
});

it('falls back to the configured rate when the request fails', function () {
    Http::fake([
        'open.er-api.com/*' => Http::response([], 500),
    ]);

    config(['services.erapi.fallback_rate' => 16000]);

    $rate = app(ExchangeRateService::class)->idr();

    expect($rate)->toBe(16000.0);
});

it('falls back when the IDR rate is missing', function () {
    Http::fake([
        'open.er-api.com/*' => Http::response([
            'result' => 'success',
            'rates' => [],
        ]),
    ]);

    config(['services.erapi.fallback_rate' => 15500]);

    $rate = app(ExchangeRateService::class)->idr();

    expect($rate)->toBe(15500.0);
});
