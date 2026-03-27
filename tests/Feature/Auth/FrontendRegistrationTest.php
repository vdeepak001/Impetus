<?php

use App\Models\State;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

test('frontend users can register from the signup modal flow', function () {
    /** @var \Tests\TestCase $this */
    Mail::fake();

    State::query()->create([
        'name' => 'Gujarat',
        'status' => 'active',
    ]);

    $response = $this->post(route('frontend.register'), [
        'name' => 'Frontend Nurse',
        'state' => 'Gujarat',
        'qualification' => 'GNM',
        'date_of_birth' => '1998-01-20',
        'email' => 'frontend.nurse@example.com',
        'phone' => '9999999999',
        'rn_number' => 'RN-12345',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHas('success');

    $user = User::query()->where('email', 'frontend.nurse@example.com')->first();

    expect($user)->not->toBeNull()
        ->and($user->role_type)->toBe('user')
        ->and($user->state)->toBe('Gujarat')
        ->and($user->qualification)->toBe('GNM')
        ->and($user->rn_number)->toBe('RN-12345')
        ->and($user->phone)->toBe('9999999999')
        ->and(Hash::check('password', $user->password))->toBeFalse();

    Mail::assertSent(\App\Mail\FrontendUserPasswordMail::class, function ($mail) use ($user) {
        return $mail->hasTo('frontend.nurse@example.com')
            && $mail->user->is($user)
            && strlen($mail->generatedPassword) >= 8;
    });
});

test('frontend registration only accepts active states', function () {
    /** @var \Tests\TestCase $this */
    State::query()->create([
        'name' => 'Inactive State',
        'status' => 'inactive',
    ]);

    $response = $this->post(route('frontend.register'), [
        'name' => 'Invalid State User',
        'state' => 'Inactive State',
        'qualification' => 'GNM',
        'date_of_birth' => '1998-01-20',
        'email' => 'inactive.state@example.com',
        'phone' => '9999999999',
        'rn_number' => 'RN-99999',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['state'], null, 'frontendRegister');
    expect(User::query()->where('email', 'inactive.state@example.com')->exists())->toBeFalse();
});

test('frontend registration rejects duplicate email addresses', function () {
    /** @var \Tests\TestCase $this */
    State::query()->create([
        'name' => 'Gujarat',
        'status' => 'active',
    ]);

    User::query()->create([
        'name' => 'Existing User',
        'email' => 'duplicate@example.com',
        'password' => Hash::make('password'),
        'role_type' => 'user',
        'active_status' => true,
    ]);

    $response = $this->post(route('frontend.register'), [
        'name' => 'New User',
        'state' => 'Gujarat',
        'qualification' => 'GNM',
        'date_of_birth' => '1998-01-20',
        'email' => 'duplicate@example.com',
        'phone' => '9999999999',
        'rn_number' => 'RN-99887',
    ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['email'], null, 'frontendRegister');
});
