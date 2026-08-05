<?php

use App\Models\Game;
use App\Models\MyGame;
use App\Models\User;

it('requires authentication to view my games', function () {
    $this->get(route('myGames.index'))->assertRedirect(route('login'));
});

it('renders the my games page with the authenticated user games', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create(['game_name' => 'Elden Ring']);

    MyGame::factory()->for($user, 'user')->for($game, 'game')->create([
        'status' => 'finished',
        'score' => 10,
    ]);

    $this->actingAs($user)
        ->get(route('myGames.index'))
        ->assertOk()
        ->assertSee('Elden Ring');
});

it('allows a user to update the status of their own game', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();

    $myGame = MyGame::factory()->for($user, 'user')->for($game, 'game')->create(['status' => 'progress']);

    $this->actingAs($user)
        ->patchJson(route('myGames.update', $myGame), ['status' => 'finished'])
        ->assertOk()
        ->assertJson(['id' => $myGame->id_myGame, 'status' => 'finished']);

    $this->assertDatabaseHas('my_games', ['id_myGame' => $myGame->id_myGame, 'status' => 'finished']);
});

it('rejects an invalid status', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();

    $myGame = MyGame::factory()->for($user, 'user')->for($game, 'game')->create(['status' => 'progress']);

    $this->actingAs($user)
        ->patchJson(route('myGames.update', $myGame), ['status' => 'unknown'])
        ->assertUnprocessable();
});

it('does not allow a user to update another user game status', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $game = Game::factory()->create();

    $myGame = MyGame::factory()->for($owner, 'user')->for($game, 'game')->create(['status' => 'progress']);

    $this->actingAs($other)
        ->patchJson(route('myGames.update', $myGame), ['status' => 'dropped'])
        ->assertForbidden();
});

it('allows a user to delete their own game', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();

    $myGame = MyGame::factory()->for($user, 'user')->for($game, 'game')->create();

    $this->actingAs($user)
        ->deleteJson(route('myGames.destroy', $myGame))
        ->assertOk();

    $this->assertDatabaseMissing('my_games', ['id_myGame' => $myGame->id_myGame]);
});

it('does not allow a user to delete another user game', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $game = Game::factory()->create();

    $myGame = MyGame::factory()->for($owner, 'user')->for($game, 'game')->create();

    $this->actingAs($other)
        ->deleteJson(route('myGames.destroy', $myGame))
        ->assertForbidden();

    $this->assertDatabaseHas('my_games', ['id_myGame' => $myGame->id_myGame]);
});

it('requires authentication to add a game', function () {
    $game = Game::factory()->create();

    $this->postJson(route('myGames.store'), [
        'id_game' => $game->id_game,
        'status' => 'planning',
    ])->assertStatus(401);
});

it('allows a user to add a game to their library', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();

    $this->actingAs($user)
        ->postJson(route('myGames.store'), [
            'id_game' => $game->id_game,
            'status' => 'progress',
        ])
        ->assertCreated()
        ->assertJson(['status' => 'progress']);

    $this->assertDatabaseHas('my_games', [
        'id_user' => $user->id_user,
        'id_game' => $game->id_game,
        'status' => 'progress',
        'score' => 0,
        'review' => '',
    ]);
});

it('returns 409 when the game is already in the library', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();

    MyGame::factory()->for($user, 'user')->for($game, 'game')->create(['status' => 'finished']);

    $this->actingAs($user)
        ->postJson(route('myGames.store'), [
            'id_game' => $game->id_game,
            'status' => 'planning',
        ])
        ->assertStatus(409);
});

it('rejects an invalid status when adding a game', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();

    $this->actingAs($user)
        ->postJson(route('myGames.store'), [
            'id_game' => $game->id_game,
            'status' => 'unknown',
        ])
        ->assertStatus(422);
});

it('rejects a non existent game when adding', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->postJson(route('myGames.store'), [
            'id_game' => 99999,
            'status' => 'planning',
        ])
        ->assertStatus(422);
});

it('renders the add button as disabled Added when the game is already in the library', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create(['game_name' => 'Elden Ring']);

    MyGame::factory()->for($user, 'user')->for($game, 'game')->create(['status' => 'finished']);

    $this->actingAs($user)
        ->get(route('games.detail', ['title' => 'Elden Ring', 'image' => $game->thumbnail]))
        ->assertOk()
        ->assertSee('Added')
        ->assertSee('disabled aria-disabled="true"');
});

it('renders the add button as active when the game is not in the library', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create(['game_name' => 'Elden Ring']);

    $this->actingAs($user)
        ->get(route('games.detail', ['title' => 'Elden Ring', 'image' => $game->thumbnail]))
        ->assertOk()
        ->assertSee('Add to My Games')
        ->assertDontSee('disabled aria-disabled="true"');
});
