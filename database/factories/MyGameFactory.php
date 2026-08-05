<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\MyGame;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MyGame>
 */
class MyGameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::factory(),
            'id_game' => Game::factory(),
            'status' => fake()->randomElement(['finished', 'progress', 'planning', 'dropped']),
            'score' => fake()->numberBetween(0, 10),
            'review' => fake()->sentence(),
            'added_date' => fake()->date(),
        ];
    }
}
