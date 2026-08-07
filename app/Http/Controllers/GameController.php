<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\MyGame;
use App\Services\SteamStoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GameController extends Controller
{
    private const TRENDING_TITLES = [
        'Cyberpunk 2077',
        'Elden Ring',
        "Baldur's Gate 3",
        'Red Dead Redemption 2',
        'Grand Theft Auto V',
        'The Witcher 3: Wild Hunt',
        'God of War Ragnarök',
        'Resident Evil 4',
        'Starfield',
        'The Last of Us Part I',
    ];

    public function __construct(private SteamStoreService $steam) {}

    public function search(Request $request): View
    {
        $keyword = trim((string) $request->query('q', ''));

        $games = $this->localGames($keyword);

        if ($keyword !== '') {
            $this->importFromSteam($keyword);
            $games = $this->localGames($keyword);
        }

        $trendingGames = Game::query()
            ->whereIn('game_name', self::TRENDING_TITLES)
            ->get()
            ->sortBy(fn (Game $game) => array_search($game->game_name, self::TRENDING_TITLES))
            ->values()
            ->take(10)
            ->map(fn (Game $game): array => ['title' => $game->game_name, 'image' => $game->thumbnail]);

        return view('search.index', [
            'games' => $games,
            'keyword' => $keyword,
            'trendingGames' => $trendingGames,
        ]);
    }

    private function localGames(string $keyword): Collection
    {
        return Game::query()
            ->when($keyword !== '', function ($query) use ($keyword) {
                return $query->where('game_name', 'like', "%{$keyword}%");
            })
            ->orderBy('game_name')
            ->get()
            ->map(fn (Game $game): array => ['title' => $game->game_name, 'image' => $game->thumbnail]);
    }

    private function importFromSteam(string $keyword): void
    {
        foreach ($this->steam->search($keyword) as $game) {
            if (Game::where('steam_appid', $game['steam_appid'])->exists()) {
                continue;
            }

            Game::create([
                'game_name' => mb_substr($game['title'], 0, 100),
                'thumbnail' => $game['image'],
                'steam_appid' => $game['steam_appid'],
            ]);
        }
    }

    public function show(Request $request): View
    {
        $title = (string) $request->query('title', 'GemuList');
        $image = $request->query('image');

        $descriptions = [
            'Cyberpunk 2077' => 'Navigate the digital sprawl of Night City in this open-world action-adventure RPG. Step into the shoes of V, a mercenary outlaw going after a one-of-a-kind implant that is the key to immortality.',
            'Elden Ring' => 'Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.',
            "Baldur's Gate 3" => 'Gather your party and return to the Forgotten Realms in a tale of fellowship and betrayal, sacrifice and survival, and the lure of absolute power.',
            'Valorant' => 'Blend your style and experience on a global, competitive stage. You have 13 rounds to attack and defend your side using sharp gunplay and tactical abilities.',
            'Starfield' => "In this next-generation role-playing game set amongst the stars, create any character you want and explore with unparalleled freedom as you embark on an epic journey to answer humanity's greatest mystery.",
            'Red Dead Redemption 2' => 'Arthur Morgan and the Van der Linde gang are outlaws on the run. With federal agents and the best bounty hunters in the nation massing on their heels, the gang must rob, steal and fight their way across America.',
            'The Witcher 3' => 'You are Geralt of Rivia, mercenary monster slayer. Before you stands a war-torn, monster-infested continent you can explore at will.',
            'God of War Ragnarök' => 'Embark on an epic and heartfelt journey as Kratos and Atreus struggle with holding on and letting go through the Nine Realms of Norse mythology.',
            'Hogwarts Legacy' => 'Experience Hogwarts in the 1800s. Your character is a student who holds the key to an ancient secret that threatens to tear the wizarding world apart.',
            'Call of Duty: Modern Warfare' => 'Drop into a visceral campaign or assemble your team in the ultimate online playground featuring multiple Ops challenges and battlegrounds.',
            'Diablo IV' => 'Endless demons to slaughter, countless abilities to master, nightmarish dungeons, and legendary loot in an expansive open world.',
            'Final Fantasy XVI' => 'An epic dark fantasy world where the fate of the land is decided by the mighty Eikons and the Dominants who wield them.',
            'Resident Evil 4' => "Survival is just the beginning. Six years have passed since the biological disaster in Raccoon City, Leon S. Kennedy is sent on a mission to rescue the president's kidnapped daughter.",
            'Street Fighter 6' => "Powered by Capcom's proprietary RE ENGINE, the Street Fighter 6 experience spans three distinct game modes featuring World Tour, Fighting Ground and Battle Hub.",
            'Mortal Kombat 1' => 'Discover a reborn Mortal Kombat Universe created by the Fire God Liu Kang featuring a new fighting system, game modes, and fatalities!',
        ];

        $defaultDescription = "Navigate the digital sprawl of Neo-Saitama in this high-octane tactical RPG. As a rogue console cowboy, you'll need to optimize your hardware and manage your reputation among the warring megacorps. Every decision impacts your trajectory through the electrified underbelly of the city.";

        $game = Game::where('game_name', $title)->first();

        $inLibrary = $game !== null && Auth::check()
            && MyGame::where('id_user', Auth::id())->where('id_game', $game->id_game)->exists();

        $steamDescription = $this->steamDescription($game);

        return view('search.detail-game', [
            'title' => $title,
            'image' => $image,
            'description' => $steamDescription ?? ($descriptions[$title] ?? $defaultDescription),
            'gameId' => $game?->id_game,
            'inLibrary' => $inLibrary,
            'isAuthed' => Auth::check(),
        ]);
    }

    private function steamDescription(?Game $game): ?string
    {
        if ($game === null || $game->steam_appid === null) {
            return null;
        }

        $detail = $this->steam->detail($game->steam_appid);

        return $detail['description'] ?? null;
    }
}
