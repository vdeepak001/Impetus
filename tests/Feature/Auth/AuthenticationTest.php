<?php

use App\Helpers\MenuHelper;
use App\Models\User;

test('login screen can be rendered', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->get('/login');

    $response->assertSuccessful();
    $response->assertSee('Log in to your account', false);
});

test('staff login screen can be rendered', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->get(route('staff.login'));

    $response->assertSuccessful();
    $response->assertSee('Staff sign in', false);
});

test('sign up screen can be rendered', function () {
    /** @var \Tests\TestCase $this */
    $response = $this->get('/register');

    $response->assertSuccessful();
    $response->assertSee('Create your account', false);
});

test('users can authenticate using the login screen', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $prefix = MenuHelper::getPrefixForRole($user->role_type);
    expect($prefix)->not->toBeNull();
    $response->assertRedirect(route($prefix.'.dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create();
    /** @var User $user */

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

test('frontend user can not login from dashboard login endpoint', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create([
        'role_type' => 'user',
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertGuest();
    $response->assertSessionHasErrors(['email']);
});

test('frontend user can login from frontend login endpoint', function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create([
        'role_type' => 'user',
    ]);

    $response = $this->post('/frontend-login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('home', absolute: false));
});
