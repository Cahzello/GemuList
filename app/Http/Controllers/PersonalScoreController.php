<?php

namespace App\Http\Controllers;

use App\Models\MyGame;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PersonalScoreController extends Controller
{
    public function index(): View
    {
        $games = Auth::user()
            ->myGames()
            ->whereIn('status', ['finished', 'dropped'])
            ->with('game')
            ->orderByDesc('added_date')
            ->get()
            ->map(fn (MyGame $myGame): array => [
                'id' => $myGame->id_myGame,
                'title' => $myGame->game->game_name,
                'status' => $myGame->status,
                'score' => $myGame->score,
                'review' => $myGame->review,
                'img' => $myGame->game->thumbnail,
                'imgAlt' => strtolower(str_replace(' ', '-', $myGame->game->game_name)),
                'hasScore' => $myGame->score > 0,
            ]);

        return view('personalScore.index', ['games' => $games]);
    }

    public function update(Request $request, MyGame $myGame): JsonResponse
    {
        abort_unless($myGame->id_user === Auth::id(), 403);

        $validated = $request->validate([
            'score' => ['nullable', 'integer', 'between:1,10'],
            'review' => ['nullable', 'string', 'max:180'],
        ]);

        $myGame->update([
            'score' => $validated['score'] ?? $myGame->score,
            'review' => $validated['review'] ?? $myGame->review,
        ]);

        return response()->json([
            'id' => $myGame->id_myGame,
            'score' => $myGame->score,
            'review' => $myGame->review,
            'hasScore' => $myGame->score > 0,
        ]);
    }
}
