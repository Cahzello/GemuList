<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    private const CACHE_KEY = 'usd_to_idr_rate';

    private const CACHE_TTL_SECONDS = 21600;

    public function idr(): float
    {
        return (float) Cache::remember(self::CACHE_KEY, self::CACHE_TTL_SECONDS, function (): float {
            $response = Http::timeout(5)->get(config('services.erapi.url'));

            if ($response->failed()) {
                return (float) config('services.erapi.fallback_rate', 16000);
            }

            $rate = $response->json('rates.IDR');

            return is_numeric($rate) ? (float) $rate : (float) config('services.erapi.fallback_rate', 16000);
        });
    }
}
