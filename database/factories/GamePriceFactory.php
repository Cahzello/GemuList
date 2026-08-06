<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\GamePrice;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GamePrice>
 */
class GamePriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = fake()->numberBetween(100000, 1000000);

        return [
            'id_game' => Game::factory(),
            'id_store' => Store::factory(),
            'price' => $price,
            'retailPrice' => $price + fake()->numberBetween(0, 200000),
            'dealUrl' => 'https://www.cheapshark.com/redirect?dealID='.fake()->uuid(),
        ];
    }
}
