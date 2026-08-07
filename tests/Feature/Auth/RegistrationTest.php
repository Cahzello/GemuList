<?php

use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
    $response->assertDontSee('x-data="{ open: true }"', false);
});

test('new users can register', function () {
    $response = $this->followingRedirects()->post('/register', [
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertOk();
    $response->assertSee('x-data="{ open: true }"', false);
    $response->assertSee('Account created successfully!', false);
});

test('registration requires all required fields', function () {
    $response = $this->post('/register', [
        'username' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ]);

    $response->assertSessionHas('alert', [
        'type' => 'alert',
        'message' => 'Please complete all required fields !',
    ]);
});

test('registration rejects mismatched password confirmation', function () {
    $response = $this->post('/register', [
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'different-password',
    ]);

    $response->assertSessionHas('alert', [
        'type' => 'alert',
        'message' => "Password Confirmation fields didn't match\nPlease try again!",
    ]);
});

test('registration rejects duplicate email', function () {
    User::factory()->create(['email' => 'taken@example.com']);

    $response = $this->post('/register', [
        'username' => 'testuser',
        'email' => 'taken@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHas('alert', [
        'type' => 'alert',
        'message' => 'An account with this email address already exists !',
    ]);
});

test('registration shows a generic failure alert for a weak password', function () {
    $response = $this->post('/register', [
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'short',
        'password_confirmation' => 'short',
    ]);

    $response->assertSessionHas('alert', [
        'type' => 'alert',
        'message' => "Failed to create an account.\nPlease try again!",
    ]);
});
