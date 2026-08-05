<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Seed the stores used by the price comparison feature.
     */
    public function run(): void
    {
        $stores = [
            ['store_name' => 'G2A', 'domain' => 'g2a.com'],
            ['store_name' => 'Epic Games', 'domain' => 'epicgames.com'],
            ['store_name' => 'Steam', 'domain' => 'store.steampowered.com'],
            ['store_name' => 'GOG', 'domain' => 'gog.com'],
        ];

        foreach ($stores as $store) {
            $slug = strtolower(str_replace(' ', '-', $store['store_name']));

            Store::updateOrCreate(
                ['store_name' => $store['store_name']],
                [
                    'banner' => "https://picsum.photos/seed/{$slug}-banner/1200/300",
                    'logo' => "https://picsum.photos/seed/{$slug}-logo/200/200",
                    'icon' => "https://www.google.com/s2/favicons?domain={$store['domain']}&sz=64",
                ],
            );
        }
    }
}
