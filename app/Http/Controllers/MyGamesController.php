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
