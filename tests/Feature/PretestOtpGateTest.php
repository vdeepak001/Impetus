<?php

use App\Models\CourseDetail;
use App\Models\Order;
use App\Models\User;
use App\Mail\PretestOtpMail;
use App\Enums\PaymentMode;
use App\Enums\PaymentStatus;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

it('blocks pretest access for users who have not verified OTP', function () {
    $user = User::factory()->create(['role_type' => 'user']);
    $course = CourseDetail::create([
        'couse_name' => 'OTP Protected Course',
        'active_status' => 1,
    ]);

    // Create a purchased order for the user
    Order::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'payment_mode' => PaymentMode::InternetBanking->value,
        'payment_status' => PaymentStatus::Completed->value,
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDay()->toDateString(),
    ]);

    // Visit pretest taking page directly
    $response = $this->actingAs($user)->get(route('cne.modules.test', [$course->couse_name, 'pre']));

    // Should be aborted with 403
    $response->assertStatus(403);
});

it('sends OTP, verifies it, and allows pretest access', function () {
    Mail::fake();

    $user = User::factory()->create([
        'role_type' => 'user',
        'email' => 'student@example.com',
    ]);
    
    $course = CourseDetail::create([
        'couse_name' => 'OTP Verified Course',
        'active_status' => 1,
    ]);

    // Create a purchased order for the user
    Order::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'payment_mode' => PaymentMode::InternetBanking->value,
        'payment_status' => PaymentStatus::Completed->value,
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDay()->toDateString(),
    ]);

    // Test Livewire component
    $component = Livewire::actingAs($user)
        ->test('cne.pretest-otp-button', [
            'course' => $course,
            'btnClass' => 'btn-test',
        ]);

    // 1. Initially, modal is not open
    $component->assertSet('showModal', false);

    // 2. Open Modal
    $component->call('openModal')
        ->assertSet('showModal', true)
        ->assertSet('otpSent', false);

    // 3. Send OTP
    $component->call('sendOtp')
        ->assertSet('otpSent', true)
        ->assertSet('isSending', false)
        ->assertSet('successMessage', 'Verification code sent successfully to your email.');

    // Assert mail was sent with OTP
    Mail::assertSent(PretestOtpMail::class, function ($mail) use ($user, $course) {
        return $mail->hasTo($user->email) &&
               $mail->courseName === $course->couse_name &&
               strlen($mail->otpCode) === 6;
    });

    // Get the generated OTP from session
    $stored = session()->get('pretest_otp_' . $course->id);
    $otp = $stored['code'];
    expect($otp)->not->toBeNull();

    // 4. Verify with wrong OTP
    $component->set('otpInput', '123456')
        ->call('verifyOtp')
        ->assertSet('errorMessage', 'Invalid verification code. 2 attempts remaining.');

    // 5. Verify with correct OTP
    $component->set('otpInput', $otp)
        ->call('verifyOtp')
        ->assertRedirect(route('cne.modules.test', [$course->couse_name, 'pre']));

    // Assert session verification flag is set
    expect(session()->has('pretest_otp_verified_' . $course->id))->toBeTrue();
});

it('invalidates the OTP after 3 failed verification attempts to prevent brute-forcing', function () {
    Mail::fake();

    $user = User::factory()->create(['role_type' => 'user']);
    $course = CourseDetail::create([
        'couse_name' => 'OTP Brute Force Course',
        'active_status' => 1,
    ]);

    Order::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'payment_mode' => PaymentMode::InternetBanking->value,
        'payment_status' => PaymentStatus::Completed->value,
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDay()->toDateString(),
    ]);

    $component = Livewire::actingAs($user)
        ->test('cne.pretest-otp-button', [
            'course' => $course,
            'btnClass' => 'btn-test',
        ]);

    $component->call('openModal');
    $component->call('sendOtp');

    // Attempt 1: Wrong Code
    $component->set('otpInput', '111111')
        ->call('verifyOtp')
        ->assertSet('errorMessage', 'Invalid verification code. 2 attempts remaining.');

    // Attempt 2: Wrong Code
    $component->set('otpInput', '222222')
        ->call('verifyOtp')
        ->assertSet('errorMessage', 'Invalid verification code. 1 attempt remaining.');

    // Attempt 3: Wrong Code (should invalidate and reset states)
    $component->set('otpInput', '333333')
        ->call('verifyOtp')
        ->assertSet('errorMessage', 'Too many incorrect attempts. This code has been invalidated. Please request a new one.')
        ->assertSet('otpSent', false)
        ->assertSet('otpInput', '');

    // Assert the session OTP is deleted
    expect(session()->has('pretest_otp_' . $course->id))->toBeFalse();
});

it('blocks mock access for users who have not verified Mock OTP', function () {
    $user = User::factory()->create(['role_type' => 'user']);
    $course = CourseDetail::create([
        'couse_name' => 'Mock OTP Protected Course',
        'active_status' => 1,
    ]);

    Order::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'payment_mode' => PaymentMode::InternetBanking->value,
        'payment_status' => PaymentStatus::Completed->value,
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDay()->toDateString(),
    ]);

    // Mock has a prerequisite of Pretest completed
    \App\Models\CourseTestAttempt::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'test_type' => \App\Enums\CourseTestType::Pre->value,
        'status' => \App\Models\CourseTestAttempt::STATUS_COMPLETED,
        'question_ids' => [1, 2, 3],
        'started_at' => now()->subHours(2),
        'completed_at' => now()->subHours(1),
        'score_percent' => 80.0,
    ]);

    $response = $this->actingAs($user)->get(route('cne.modules.test', [$course->couse_name, 'mock']));
    $response->assertStatus(403);
});

it('sends Mock OTP, verifies it, and allows mock access', function () {
    Mail::fake();

    $user = User::factory()->create([
        'role_type' => 'user',
        'email' => 'student-mock@example.com',
    ]);
    
    $course = CourseDetail::create([
        'couse_name' => 'Mock OTP Verified Course',
        'active_status' => 1,
    ]);

    Order::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'payment_mode' => PaymentMode::InternetBanking->value,
        'payment_status' => PaymentStatus::Completed->value,
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDay()->toDateString(),
    ]);

    // Prerequisite: completed Pretest
    \App\Models\CourseTestAttempt::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'test_type' => \App\Enums\CourseTestType::Pre->value,
        'status' => \App\Models\CourseTestAttempt::STATUS_COMPLETED,
        'question_ids' => [1, 2, 3],
        'started_at' => now()->subHours(2),
        'completed_at' => now()->subHours(1),
        'score_percent' => 80.0,
    ]);

    $component = Livewire::actingAs($user)
        ->test('cne.pretest-otp-button', [
            'course' => $course,
            'btnClass' => 'btn-mock',
            'testType' => 'mock',
            'btnLabel' => 'Mock',
        ]);

    $component->call('openModal')
        ->assertSet('showModal', true);

    $component->call('sendOtp')
        ->assertSet('otpSent', true);

    Mail::assertSent(PretestOtpMail::class, function ($mail) use ($user, $course) {
        return $mail->hasTo($user->email) &&
               $mail->courseName === $course->couse_name &&
               $mail->testLabel === 'Mock Test';
    });

    $stored = session()->get('mocktest_otp_' . $course->id);
    $otp = $stored['code'];

    $component->set('otpInput', $otp)
        ->call('verifyOtp')
        ->assertRedirect(route('cne.modules.test', [$course->couse_name, 'mock']));

    expect(session()->has('mocktest_otp_verified_' . $course->id))->toBeTrue();
});

it('blocks final access for users who have not verified Final OTP', function () {
    $user = User::factory()->create(['role_type' => 'user']);
    $course = CourseDetail::create([
        'couse_name' => 'Final OTP Protected Course',
        'active_status' => 1,
    ]);

    Order::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'payment_mode' => PaymentMode::InternetBanking->value,
        'payment_status' => PaymentStatus::Completed->value,
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDay()->toDateString(),
    ]);

    // Prerequisite: completed Pretest
    \App\Models\CourseTestAttempt::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'test_type' => \App\Enums\CourseTestType::Pre->value,
        'status' => \App\Models\CourseTestAttempt::STATUS_COMPLETED,
        'question_ids' => [1, 2, 3],
        'started_at' => now()->subHours(4),
        'completed_at' => now()->subHours(3),
        'score_percent' => 85.0,
    ]);

    // Prerequisite: completed Mock test
    \App\Models\CourseTestAttempt::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'test_type' => \App\Enums\CourseTestType::Mock->value,
        'status' => \App\Models\CourseTestAttempt::STATUS_COMPLETED,
        'question_ids' => [1, 2, 3],
        'started_at' => now()->subHours(2),
        'completed_at' => now()->subHours(1),
        'score_percent' => 90.0,
    ]);

    $response = $this->actingAs($user)->get(route('cne.modules.test', [$course->couse_name, 'final']));
    $response->assertStatus(403);
});

it('sends Final OTP, verifies it, and allows final access', function () {
    Mail::fake();

    $user = User::factory()->create([
        'role_type' => 'user',
        'email' => 'student-final@example.com',
    ]);
    
    $course = CourseDetail::create([
        'couse_name' => 'Final OTP Verified Course',
        'active_status' => 1,
    ]);

    Order::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'payment_mode' => PaymentMode::InternetBanking->value,
        'payment_status' => PaymentStatus::Completed->value,
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addDay()->toDateString(),
    ]);

    // Prerequisite: completed Pretest
    \App\Models\CourseTestAttempt::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'test_type' => \App\Enums\CourseTestType::Pre->value,
        'status' => \App\Models\CourseTestAttempt::STATUS_COMPLETED,
        'question_ids' => [1, 2, 3],
        'started_at' => now()->subHours(4),
        'completed_at' => now()->subHours(3),
        'score_percent' => 85.0,
    ]);

    // Prerequisite: completed Mock test
    \App\Models\CourseTestAttempt::create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'test_type' => \App\Enums\CourseTestType::Mock->value,
        'status' => \App\Models\CourseTestAttempt::STATUS_COMPLETED,
        'question_ids' => [1, 2, 3],
        'started_at' => now()->subHours(2),
        'completed_at' => now()->subHours(1),
        'score_percent' => 90.0,
    ]);

    $component = Livewire::actingAs($user)
        ->test('cne.pretest-otp-button', [
            'course' => $course,
            'btnClass' => 'btn-final',
            'testType' => 'final',
            'btnLabel' => 'Final',
        ]);

    $component->call('openModal')
        ->assertSet('showModal', true);

    $component->call('sendOtp')
        ->assertSet('otpSent', true);

    Mail::assertSent(PretestOtpMail::class, function ($mail) use ($user, $course) {
        return $mail->hasTo($user->email) &&
               $mail->courseName === $course->couse_name &&
               $mail->testLabel === 'Final Test';
    });

    $stored = session()->get('finaltest_otp_' . $course->id);
    $otp = $stored['code'];

    $component->set('otpInput', $otp)
        ->call('verifyOtp')
        ->assertRedirect(route('cne.modules.test', [$course->couse_name, 'final']));

    expect(session()->has('finaltest_otp_verified_' . $course->id))->toBeTrue();
});

