<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'store_name' => fake()->unique()->company(),
            'banner' => fake()->imageUrl(1200, 300, 'banner'),
            'logo' => fake()->imageUrl(200, 200, 'logo'),
            'icon' => fake()->imageUrl(64, 64, 'icon'),
        ];
    }
}
