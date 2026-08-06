<?php

use App\Models\Game;
use App\Models\MyGame;
use App\Models\User;

it('requires authentication to view personal score', function () {
    $this->get(route('personalScore.index'))->assertRedirect(route('login'));
});

it('only shows finished and dropped games on the personal score page', function () {
    $user = User::factory()->create();
    $finishedGame = Game::factory()->create(['game_name' => 'Finished Game']);
    $planningGame = Game::factory()->create(['game_name' => 'Planning Game']);

    MyGame::factory()->for($user, 'user')->for($finishedGame, 'game')->create([
        'status' => 'finished',
        'score' => 9,
        'review' => 'Great game',
    ]);

    MyGame::factory()->for($user, 'user')->for($planningGame, 'game')->create([
        'status' => 'planning',
        'score' => 0,
        'review' => '',
    ]);

    $this->actingAs($user)
        ->get(route('personalScore.index'))
        ->assertOk()
        ->assertSee('Finished Game')
        ->assertDontSee('Planning Game');
});

it('allows a user to submit a score and review for their own game', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();

    $myGame = MyGame::factory()->for($user, 'user')->for($game, 'game')->create([
        'status' => 'finished',
        'score' => 0,
        'review' => '',
    ]);

    $this->actingAs($user)
        ->postJson(route('personalScore.update', $myGame), [
            'score' => 8,
            'review' => 'A solid experience.',
        ])
        ->assertOk()
        ->assertJson([
            'id' => $myGame->id_myGame,
            'score' => 8,
            'review' => 'A solid experience.',
            'hasScore' => true,
        ]);

    $this->assertDatabaseHas('my_games', ['id_myGame' => $myGame->id_myGame, 'score' => 8]);
});

it('rejects a score out of range', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();

    $myGame = MyGame::factory()->for($user, 'user')->for($game, 'game')->create();

    $this->actingAs($user)
        ->postJson(route('personalScore.update', $myGame), ['score' => 11])
        ->assertUnprocessable();
});

it('rejects a review longer than 180 characters', function () {
    $user = User::factory()->create();
    $game = Game::factory()->create();

    $myGame = MyGame::factory()->for($user, 'user')->for($game, 'game')->create();

    $this->actingAs($user)
        ->postJson(route('personalScore.update', $myGame), ['review' => str_repeat('a', 181)])
        ->assertUnprocessable();
});

it('does not allow a user to score another user game', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $game = Game::factory()->create();

    $myGame = MyGame::factory()->for($owner, 'user')->for($game, 'game')->create();

    $this->actingAs($other)
        ->postJson(route('personalScore.update', $myGame), ['score' => 9, 'review' => 'Nice'])
        ->assertForbidden();
});
