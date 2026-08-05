<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Services\CheapSharkService;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    private const STORES = [
        ['id' => 1, 'name' => 'Steam'],
        ['id' => 2, 'name' => 'GamersGate'],
        ['id' => 3, 'name' => 'GreenManGaming'],
        ['id' => 7, 'name' => 'GOG'],
        ['id' => 11, 'name' => 'Humble Store'],
        ['id' => 13, 'name' => 'Uplay'],
        ['id' => 15, 'name' => 'Fanatical'],
        ['id' => 21, 'name' => 'WinGameStore'],
        ['id' => 23, 'name' => 'GameBillet'],
        ['id' => 25, 'name' => 'Epic Games Store'],
        ['id' => 27, 'name' => 'Gamesplanet'],
        ['id' => 28, 'name' => 'Gamesload'],
        ['id' => 30, 'name' => 'IndieGala'],
        ['id' => 35, 'name' => 'DreamGame'],
    ];

    /**
     * Seed the active CheapShark stores.
     */
    public function run(): void
    {
        foreach (self::STORES as $store) {
            Store::updateOrCreate(
                ['cheapshark_id' => $store['id']],
                [
                    'store_name' => $store['name'],
                    'banner' => 'https://www.cheapshark.com/img/stores/banners/'.($store['id'] - 1).'.png',
                    'logo' => 'https://www.cheapshark.com/img/stores/logos/'.($store['id'] - 1).'.png',
                    'icon' => 'https://www.cheapshark.com/img/stores/icons/'.($store['id'] - 1).'.png',
                    'url' => CheapSharkService::STORE_HOMEPAGES[$store['name']] ?? 'https://www.cheapshark.com',
                ],
            );
        }
    }
}
