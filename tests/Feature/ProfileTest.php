<?php

use App\Enums\PaymentMode;
use App\Enums\PaymentStatus;
use App\Models\CourseDetail;
use App\Models\Order;
use App\Models\User;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertOk();
});

test('frontend user sees profile tabs page', function () {
    $user = User::factory()->create([
        'role_type' => 'user',
    ]);

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertOk();
    $response->assertSee('Personal Information');
    $response->assertSee('Academic Information');
    $response->assertSee('Professional Information');
    $response->assertSee('My Course');
});

test('frontend user sees purchased courses from orders table', function () {
    $user = User::factory()->create([
        'role_type' => 'user',
    ]);

    $course = CourseDetail::create([
        'couse_name' => 'Critical Care Basics',
        'active_status' => 1,
    ]);

    Order::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'payment_mode' => PaymentMode::InternetBanking->value,
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addMonth()->toDateString(),
        'payment_status' => PaymentStatus::Completed->value,
    ]);

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertOk();
    $response->assertSee('Critical Care Basics');
    $response->assertDontSee('No modules available yet.');
});

test('authenticated user can view change password page', function () {
    $user = User::factory()->create([
        'role_type' => 'user',
    ]);

    $response = $this
        ->actingAs($user)
        ->get('/change-password');

    $response->assertOk();
    $response->assertSee('Change Password');
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
});

test('frontend profile extended information can be updated', function () {
    $user = User::factory()->create([
        'role_type' => 'user',
    ]);

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Frontend User',
            'email' => 'frontend.profile@example.com',
            'phone' => '9999999999',
            'gender' => 'female',
            'rn_number' => 'RN-100',
            'rm_number' => 'RM-200',
            'academic_state' => 'Gujarat',
            'institution_name' => 'Nursing Institute',
            'organization_name' => 'City Hospital',
            'organization_type' => 'Hospital',
            'department_name' => 'Emergency',
            'professional_city' => 'Surat',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    expect($user->name)->toBe('Frontend User')
        ->and($user->email)->toBe('frontend.profile@example.com')
        ->and($user->phone)->toBe('9999999999')
        ->and($user->gender)->toBe('female')
        ->and($user->rn_number)->toBe('RN-100')
        ->and($user->rm_number)->toBe('RM-200')
        ->and($user->academic_state)->toBe('Gujarat')
        ->and($user->institution_name)->toBe('Nursing Institute')
        ->and($user->organization_name)->toBe('City Hospital')
        ->and($user->organization_type)->toBe('Hospital')
        ->and($user->department_name)->toBe('Emergency')
        ->and($user->professional_city)->toBe('Surat');
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => $user->email,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/profile', [
            'password' => 'password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'wrong-password',
        ]);

    $response
        ->assertSessionHasErrorsIn('userDeletion', 'password')
        ->assertRedirect('/profile');

    $this->assertNotNull($user->fresh());
});
