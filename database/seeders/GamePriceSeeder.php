<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\GamePrice;
use App\Models\Store;
use Illuminate\Database\Seeder;

class GamePriceSeeder extends Seeder
{
    /**
     * Seed a price record for every game in every store.
     */
    public function run(): void
    {
        $discountFactors = [
            'G2A' => 0.9,
            'Epic Games' => 1.05,
            'Steam' => 1.0,
            'GOG' => 0.95,
        ];

        $stores = Store::all();

        Game::query()->each(function (Game $game) use ($stores, $discountFactors): void {
            foreach ($stores as $store) {
                $base = 200000 + (($game->id_game * 7919 + $store->id_store * 104729) % 900000);
                $factor = $discountFactors[$store->store_name] ?? 1.0;

                $price = (int) round($base * $factor / 1000) * 1000;
                $retailPrice = (int) round($price * 1.15 / 1000) * 1000;

                GamePrice::updateOrCreate(
                    ['id_game' => $game->id_game, 'id_store' => $store->id_store],
                    ['price' => $price, 'retailPrice' => $retailPrice],
                );
            }
        });
    }
}
