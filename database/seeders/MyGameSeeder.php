<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\MyGame;
use App\Models\User;
use Illuminate\Database\Seeder;

class MyGameSeeder extends Seeder
{
    /**
     * Seed a sample library for the demo user.
     */
    public function run(): void
    {
        $user = User::where('email', 'test@example.com')->first();

        if ($user === null) {
            return;
        }

        $entries = [
            ['title' => 'Cyberpunk 2077', 'status' => 'progress', 'score' => 9, 'review' => 'Night City is a masterpiece of atmosphere and freedom.', 'added_date' => '2026-01-12'],
            ['title' => 'Elden Ring', 'status' => 'finished', 'score' => 10, 'review' => 'A towering achievement in open world design.', 'added_date' => '2025-11-03'],
            ['title' => 'The Witcher 3: Wild Hunt', 'status' => 'finished', 'score' => 9, 'review' => 'One of the best RPGs ever made.', 'added_date' => '2025-09-20'],
            ['title' => 'Red Dead Redemption 2', 'status' => 'finished', 'score' => 10, 'review' => 'A cinematic masterpiece from start to finish.', 'added_date' => '2025-07-08'],
            ['title' => 'Hades', 'status' => 'progress', 'score' => 8, 'review' => 'Tight, fast and endlessly replayable.', 'added_date' => '2026-02-01'],
            ['title' => "Baldur's Gate 3", 'status' => 'planning', 'score' => 0, 'review' => '', 'added_date' => '2026-02-15'],
            ['title' => 'Starfield', 'status' => 'dropped', 'score' => 6, 'review' => 'Lots of space, less magic.', 'added_date' => '2025-12-05'],
            ['title' => 'Valorant', 'status' => 'progress', 'score' => 7, 'review' => 'Sharp gunplay, competitive and addictive.', 'added_date' => '2026-01-28'],
        ];

        foreach ($entries as $entry) {
            $game = Game::where('game_name', $entry['title'])->first();

            if ($game === null) {
                continue;
            }

            MyGame::updateOrCreate(
                ['id_user' => $user->id_user, 'id_game' => $game->id_game],
                [
                    'status' => $entry['status'],
                    'score' => $entry['score'],
                    'review' => $entry['review'],
                    'added_date' => $entry['added_date'],
                ],
            );
        }
    }
}
