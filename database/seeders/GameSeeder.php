<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Seed the games table from the games config.
     */
    public function run(): void
    {
        foreach (config('games.list', []) as $game) {
            Game::updateOrCreate(
                ['game_name' => $game['title']],
                ['thumbnail' => $game['image']],
            );
        }
    }
}
