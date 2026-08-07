<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
    $response->assertDontSee('x-data="{ open: true }"', false);
});

test('login shows an alert modal when required fields are missing', function () {
    $response = $this->followingRedirects()->post('/login', [
        'email' => '',
        'password' => '',
    ]);

    $response->assertOk();
    $response->assertSee('x-data="{ open: true }"', false);
    $response->assertSee('Please complete all required fields !', false);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('games.search', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
    $response->assertSessionHas('alert', [
        'type' => 'alert',
        'message' => "Invalid Email or Password\nPlease try again!",
    ]);
});

test('login requires all required fields', function () {
    $response = $this->post('/login', [
        'email' => '',
        'password' => '',
    ]);

    $response->assertSessionHas('alert', [
        'type' => 'alert',
        'message' => 'Please complete all required fields !',
    ]);
});

test('login shows a failure alert after too many attempts', function () {
    $user = User::factory()->create();

    $response = null;

    foreach (range(1, 6) as $attempt) {
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
    }

    $response->assertSessionHas('alert', [
        'type' => 'alert',
        'message' => "Login failed.\nPlease try again!",
    ]);
});

test('authenticated pages show the logout confirmation dialog', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('games.search'));

    $response->assertStatus(200);
    $response->assertSee('Are you sure you want to logout?', false);
    $response->assertSee('data-confirm-trigger', false);
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
