<?php

use App\Helpers\MenuHelper;
use App\Mail\FrontendUserPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

test('frontend resend password stores readable password for staff view', function () {
    /** @var \Tests\TestCase $this */
    Mail::fake();

    $user = User::factory()->create([
        'role_type' => 'user',
        'password_raw' => null,
    ]);

    $response = $this->post(route('frontend.password.resend'), [
        'email' => $user->email,
    ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success');

    $user->refresh();
    expect($user->password_raw)->toBeString()
        ->and(strlen($user->password_raw))->toBe(10)
        ->and(Hash::check($user->password_raw, $user->password))->toBeTrue();

    Mail::assertSent(FrontendUserPasswordMail::class, function (FrontendUserPasswordMail $mail) use ($user): bool {
        return $mail->hasTo((string) $user->email)
            && $mail->generatedPassword === $user->password_raw;
    });
});
