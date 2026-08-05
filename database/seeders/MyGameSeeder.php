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
        $user = User::where('email', 'budi@gmail.com')->first();

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
            ['title' => 'The Last of Us Part I', 'status' => 'finished', 'score' => 9, 'review' => 'A heartbreaking story told with impeccable craft.', 'added_date' => '2025-06-14'],
            ['title' => 'God of War Ragnarök', 'status' => 'finished', 'score' => 10, 'review' => 'A worthy sequel that raises the bar for cinematic action.', 'added_date' => '2025-05-02'],
            ['title' => 'Resident Evil 4', 'status' => 'finished', 'score' => 8, 'review' => 'Survival horror at its most refined and tense.', 'added_date' => '2025-04-11'],
            ['title' => 'Sekiro: Shadows Die Twice', 'status' => 'finished', 'score' => 9, 'review' => 'A razor-sharp test of patience and rhythm.', 'added_date' => '2025-03-09'],
            ['title' => 'Hollow Knight', 'status' => 'dropped', 'score' => 7, 'review' => 'Gorgeous atmosphere, but the map drained my patience.', 'added_date' => '2025-02-19'],
            ['title' => 'Celeste', 'status' => 'finished', 'score' => 8, 'review' => 'Tight platforming wrapped in a deeply human story.', 'added_date' => '2025-01-27'],
            ['title' => 'Dark Souls III', 'status' => 'dropped', 'score' => 8, 'review' => 'Brilliant bosses, but I ran out of steam halfway.', 'added_date' => '2024-12-30'],
            ['title' => 'Stardew Valley', 'status' => 'finished', 'score' => 8, 'review' => 'Cozy, charming and dangerously easy to sink hours into.', 'added_date' => '2024-11-18'],
            ['title' => 'Grand Theft Auto V', 'status' => 'progress', 'score' => 8, 'review' => 'Still the best sandbox out there.', 'added_date' => '2026-01-05'],
            ['title' => 'Detroit: Become Human', 'status' => 'planning', 'score' => 0, 'review' => '', 'added_date' => '2026-02-20'],
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
