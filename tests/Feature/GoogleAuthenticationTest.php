<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;

uses(RefreshDatabase::class);

it('redirects home with an error when Google OAuth is not configured', function () {
    config([
        'services.google.client_id' => null,
        'services.google.client_secret' => null,
    ]);

    $this->get(route('auth.google.redirect'))
        ->assertRedirect(route('home'))
        ->assertSessionHas('error');
});

it('redirects to Google when OAuth credentials are configured', function () {
    config([
        'services.google.client_id' => 'test-google-client-id',
        'services.google.client_secret' => 'test-google-client-secret',
        'services.google.redirect' => 'https://example.test/auth/google/callback',
    ]);

    $response = $this->get(route('auth.google.redirect'));

    $response->assertRedirect();
    expect($response->headers->get('Location'))->toContain('accounts.google.com');
});

it('creates a frontend user and logs in after a successful Google callback', function () {
    config([
        'services.google.client_id' => 'test-google-client-id',
        'services.google.client_secret' => 'test-google-client-secret',
        'services.google.redirect' => 'https://example.test/auth/google/callback',
    ]);

    $socialiteUser = \Mockery::mock(\Laravel\Socialite\Two\User::class);
    $socialiteUser->shouldReceive('getId')->andReturn('google-oauth-test-id');
    $socialiteUser->shouldReceive('getEmail')->andReturn('oauth-new-user@example.com');
    $socialiteUser->shouldReceive('getName')->andReturn('OAuth Test User');

    $provider = \Mockery::mock(\Laravel\Socialite\Contracts\Provider::class);
    $provider->shouldReceive('user')->andReturn($socialiteUser);

    Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

    $this->get(route('auth.google.callback'))
        ->assertRedirect(route('home'));

    $this->assertAuthenticated();

    $created = User::query()->where('google_id', 'google-oauth-test-id')->first();
    expect($created)->not->toBeNull()
        ->and($created->role_type)->toBe('user')
        ->and($created->active_status)->toBeTrue();
});

it('rejects Google sign-in when the email belongs to a non-frontend account', function () {
    config([
        'services.google.client_id' => 'test-google-client-id',
        'services.google.client_secret' => 'test-google-client-secret',
        'services.google.redirect' => 'https://example.test/auth/google/callback',
    ]);

    User::factory()->create([
        'email' => 'staff@example.com',
        'role_type' => 'admin',
    ]);

    $socialiteUser = \Mockery::mock(\Laravel\Socialite\Two\User::class);
    $socialiteUser->shouldReceive('getId')->andReturn('google-staff-try');
    $socialiteUser->shouldReceive('getEmail')->andReturn('staff@example.com');
    $socialiteUser->shouldReceive('getName')->andReturn('Staff User');

    $provider = \Mockery::mock(\Laravel\Socialite\Contracts\Provider::class);
    $provider->shouldReceive('user')->andReturn($socialiteUser);

    Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

    $this->get(route('auth.google.callback'))
        ->assertRedirect(route('home'))
        ->assertSessionHas('error');

    $this->assertGuest();
});
