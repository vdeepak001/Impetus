<?php

use App\Models\CourseDetail;
use App\Models\Order;
use App\Models\State;
use App\Models\StateCouncil;
use App\Models\User;

it('returns state-scoped courses as json for staff', function () {
    $state = State::query()->create([
        'name' => 'Madhya Pradesh',
        'status' => 'active',
    ]);

    $course = CourseDetail::query()->create([
        'couse_name' => 'Scoped Course',
        'description' => 'Test',
        'active_status' => 1,
    ]);

    $council = StateCouncil::query()->create([
        'state_id' => $state->id,
        'council_name' => 'MP Council',
        'active_status' => true,
    ]);
    $council->courseDetails()->attach($course->id);

    $learner = User::factory()->create([
        'role_type' => 'user',
        'state' => 'Madhya Pradesh',
    ]);

    $staff = User::factory()->create(['role_type' => 'superadmin']);

    $this->actingAs($staff)
        ->getJson(route('super-admin.users-list.state-courses', ['userId' => $learner->id]))
        ->assertSuccessful()
        ->assertJsonFragment(['id' => $course->id, 'name' => 'Scoped Course']);
});

it('stores an order for a learner module payment', function () {
    $state = State::query()->create([
        'name' => 'Madhya Pradesh',
        'status' => 'active',
    ]);

    $course = CourseDetail::query()->create([
        'couse_name' => 'Payable Course',
        'description' => 'Test',
        'active_status' => 1,
    ]);

    $council = StateCouncil::query()->create([
        'state_id' => $state->id,
        'council_name' => 'MP Council',
        'active_status' => true,
    ]);
    $council->courseDetails()->attach($course->id);

    $learner = User::factory()->create([
        'role_type' => 'user',
        'state' => 'Madhya Pradesh',
    ]);

    $staff = User::factory()->create(['role_type' => 'superadmin']);

    $start = now()->toDateString();
    $end = now()->addMonth()->toDateString();

    $this->actingAs($staff)
        ->postJson(route('super-admin.users-list.orders.store', ['userId' => $learner->id]), [
            'course_detail_id' => $course->id,
            'payment_mode' => 'internet_banking',
            'start_date' => $start,
            'end_date' => $end,
            'remarks' => 'Bank transfer received',
        ])
        ->assertSuccessful()
        ->assertJsonFragment(['message' => 'Order recorded successfully.']);

    expect(Order::query()->where('user_id', $learner->id)->where('course_detail_id', $course->id)->exists())->toBeTrue();
});

it('rejects an order when the end date is before the start date', function () {
    $learner = User::factory()->create(['role_type' => 'user', 'state' => 'Madhya Pradesh']);
    $staff = User::factory()->create(['role_type' => 'superadmin']);

    $this->actingAs($staff)
        ->postJson(route('super-admin.users-list.orders.store', ['userId' => $learner->id]), [
            'course_detail_id' => 999999,
            'payment_mode' => 'paytm',
            'start_date' => now()->toDateString(),
            'end_date' => now()->subDay()->toDateString(),
            'remarks' => null,
        ])
        ->assertUnprocessable();
});

it('shows purchased label on CPD listing when the learner has a completed order in range', function () {
    $state = State::query()->create([
        'name' => 'Madhya Pradesh',
        'status' => 'active',
    ]);

    $course = CourseDetail::query()->create([
        'couse_name' => 'Labeled Course',
        'description' => 'Test',
        'active_status' => 1,
    ]);

    $council = StateCouncil::query()->create([
        'state_id' => $state->id,
        'council_name' => 'MP Council',
        'active_status' => true,
    ]);
    $council->courseDetails()->attach($course->id);

    $learner = User::factory()->create([
        'role_type' => 'user',
        'state' => 'Madhya Pradesh',
    ]);

    Order::factory()->create([
        'user_id' => $learner->id,
        'course_detail_id' => $course->id,
        'state_council_id' => $council->id,
        'start_date' => now()->subDay(),
        'end_date' => now()->addMonth(),
    ]);

    $this->actingAs($learner)->get(route('cne.modules'))
        ->assertSuccessful()
        ->assertSee('Purchased');
});

it('shows purchased on module detail instead of buy now when applicable', function () {
    $state = State::query()->create([
        'name' => 'Madhya Pradesh',
        'status' => 'active',
    ]);

    $course = CourseDetail::query()->create([
        'couse_name' => 'Detail Purchased',
        'description' => 'Test',
        'active_status' => 1,
    ]);

    $council = StateCouncil::query()->create([
        'state_id' => $state->id,
        'council_name' => 'MP Council',
        'active_status' => true,
    ]);
    $council->courseDetails()->attach($course->id);

    $learner = User::factory()->create([
        'role_type' => 'user',
        'state' => 'Madhya Pradesh',
    ]);

    Order::factory()->create([
        'user_id' => $learner->id,
        'course_detail_id' => $course->id,
        'state_council_id' => $council->id,
        'start_date' => now()->subDay(),
        'end_date' => now()->addMonth(),
    ]);

    $this->actingAs($learner)->get(route('cne.modules.show', $course))
        ->assertSuccessful()
        ->assertSee('Purchased')
        ->assertDontSee('Buy now');
});
