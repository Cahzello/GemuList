<?php

namespace App\Http\Controllers;

use App\Models\MyGame;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MyGamesController extends Controller
{
    public function index(): View
    {
        $games = Auth::user()
            ->myGames()
            ->with('game')
            ->get()
            ->map(fn (MyGame $myGame): array => [
                'id' => $myGame->id_myGame,
                'title' => $myGame->game->game_name,
                'cover' => $myGame->game->thumbnail,
                'status' => $myGame->status,
            ]);

        return view('myGames.index', ['games' => $games]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id_game' => ['required', 'integer', 'exists:games,id_game'],
            'status' => ['required', 'in:planning,progress,finished,dropped'],
        ]);

        $exists = MyGame::where('id_user', Auth::id())
            ->where('id_game', $validated['id_game'])
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Game already in your library.'], 409);
        }

        $myGame = MyGame::create([
            'id_user' => Auth::id(),
            'id_game' => $validated['id_game'],
            'status' => $validated['status'],
            'score' => 0,
            'review' => '',
            'added_date' => now()->toDateString(),
        ]);

        return response()->json([
            'id' => $myGame->id_myGame,
            'status' => $myGame->status,
        ], 201);
    }

    public function update(Request $request, MyGame $myGame): JsonResponse
    {
        $this->authorizeOwnership($myGame);

        $validated = $request->validate([
            'status' => ['required', 'in:planning,progress,finished,dropped'],
        ]);

        $myGame->update(['status' => $validated['status']]);

        return response()->json([
            'id' => $myGame->id_myGame,
            'status' => $myGame->status,
        ]);
    }

    public function destroy(MyGame $myGame): JsonResponse
    {
        $this->authorizeOwnership($myGame);

        $myGame->delete();

        return response()->json(['success' => true]);
    }

    private function authorizeOwnership(MyGame $myGame): void
    {
        abort_unless($myGame->id_user === Auth::id(), 403);
    }
}
