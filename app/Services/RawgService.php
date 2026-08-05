<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RawgService
{
    /**
     * @return list<array{title: string, image: string}>
     */
    public function search(string $query, int $pageSize = 12): array
    {
        $key = (string) config('services.rawg.key', '');

        if ($key === '') {
            return [];
        }

        try {
            $response = Http::timeout(10)
                ->get(config('services.rawg.url').'/games', [
                    'key' => $key,
                    'search' => $query,
                    'page_size' => $pageSize,
                ]);
        } catch (\Throwable $e) {
            Log::warning('RAWG request failed', ['query' => $query, 'error' => $e->getMessage()]);

            return [];
        }

        if ($response->failed()) {
            Log::warning('RAWG returned an error', [
                'query' => $query,
                'status' => $response->status(),
            ]);

            return [];
        }

        return collect($response->json('results', []))
            ->filter(fn (array $game): bool => isset($game['name'], $game['background_image']))
            ->map(fn (array $game): array => [
                'title' => $game['name'],
                'image' => $game['background_image'],
            ])
            ->values()
            ->all();
    }
}
