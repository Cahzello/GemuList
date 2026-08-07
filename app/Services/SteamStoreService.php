<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SteamStoreService
{
    /**
     * @return list<array{title: string, image: string, steam_appid: int}>
     */
    public function search(string $term): array
    {
        $response = $this->request('/api/storesearch', [
            'term' => $term,
            'cc' => (string) config('services.steamstore.cc', 'ID'),
            'l' => (string) config('services.steamstore.language', 'english'),
        ]);

        if ($response === null) {
            return [];
        }

        return collect($response->json('items', []))
            ->filter(fn (array $item): bool => ($item['type'] ?? null) === 'app' && isset($item['name']))
            ->map(fn (array $item): array => [
                'title' => $item['name'],
                'image' => $this->portraitCover((int) $item['id'], $item['tiny_image'] ?? null),
                'steam_appid' => (int) $item['id'],
            ])
            ->values()
            ->all();
    }

    /**
     * @param  list<string>  $titles
     * @return list<array{title: string, image: string}>
     */
    public function trending(array $titles): array
    {
        $trending = [];

        foreach ($titles as $title) {
            $results = $this->search($title);

            if ($results === []) {
                continue;
            }

            $trending[] = ['title' => $title, 'image' => $results[0]['image']];
        }

        return $trending;
    }

    /**
     * @return array{title: ?string, description: string, image: string, releaseDate: ?string, genres: list<string>}|null
     */
    public function detail(int $appId): ?array
    {
        $response = $this->request('/api/appdetails', ['appids' => $appId]);

        if ($response === null) {
            return null;
        }

        $data = $response->json((string) $appId);

        if (! is_array($data) || ($data['success'] ?? false) !== true) {
            return null;
        }

        $info = is_array($data['data'] ?? null) ? $data['data'] : [];

        return [
            'title' => $info['name'] ?? null,
            'description' => $this->stripHtml((string) ($info['detailed_description'] ?? '')),
            'image' => $this->portraitCover($appId, $info['header_image'] ?? null),
            'releaseDate' => $info['release_date']['date'] ?? null,
            'genres' => collect($info['genres'] ?? [])->pluck('description')->all(),
        ];
    }

    private function portraitCover(int $appId, ?string $fallback = null): string
    {
        $cover = "https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/{$appId}/library_600x900.jpg";

        return $this->coverExists($cover) ? $cover : ($fallback ?? $cover);
    }

    private function coverExists(string $url): bool
    {
        try {
            return Http::timeout(5)->head($url)->successful();
        } catch (\Throwable $e) {
            Log::warning('Steam cover check failed', ['url' => $url, 'error' => $e->getMessage()]);

            return false;
        }
    }

    private function request(string $path, array $query): ?Response
    {
        try {
            $response = Http::timeout(10)->get(config('services.steamstore.url').$path, $query);
        } catch (\Throwable $e) {
            Log::warning('Steam Store request failed', ['path' => $path, 'error' => $e->getMessage()]);

            return null;
        }

        if ($response->failed()) {
            Log::warning('Steam Store returned an error', ['path' => $path, 'status' => $response->status()]);

            return null;
        }

        return $response;
    }

    private function stripHtml(string $html): string
    {
        $text = trim(strip_tags(str_replace(['<br>', '<br/>', '<br />'], "\n", $html)));

        return preg_replace('/\s+/u', ' ', $text) ?? $text;
    }
}
