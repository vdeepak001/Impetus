<?php

use App\Models\CourseDetail;
use App\Models\Order;
use App\Models\State;
use App\Models\StateCouncil;
use App\Models\User;

it('lists recorded orders for super admin', function () {
    $state = State::query()->create([
        'name' => 'Madhya Pradesh',
        'status' => 'active',
    ]);

    $course = CourseDetail::query()->create([
        'couse_name' => 'Listed Module Course',
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
        'email' => 'learner-orders@example.test',
    ]);

    $staff = User::factory()->create(['role_type' => 'superadmin']);

    Order::query()->create([
        'user_id' => $learner->id,
        'course_detail_id' => $course->id,
        'state_council_id' => $council->id,
        'payment_mode' => 'internet_banking',
        'start_date' => now()->toDateString(),
        'end_date' => now()->addMonth()->toDateString(),
        'remarks' => 'Test remark line',
        'payment_status' => 'completed',
        'recorded_by_id' => $staff->id,
    ]);

    $response = $this->actingAs($staff)->get(route('super-admin.order-details.index'));

    $response->assertSuccessful();
    $response->assertSee('Listed Module Course');
    $response->assertSee('learner-orders@example.test');
    $response->assertSee('MP Council');
    $response->assertSee('Test remark line');
});

it('allows support role to view order details', function () {
    $support = User::factory()->create(['role_type' => 'support']);

    $this->actingAs($support)->get(route('support.order-details.index'))->assertSuccessful();
});

it('redirects frontend learners away from order details', function () {
    $customer = User::factory()->create(['role_type' => 'user']);

    $this->actingAs($customer)
        ->get(route('super-admin.order-details.index'))
        ->assertRedirect(route('login'));
});

it('filters order details by search, mode and status', function () {
    $state = State::query()->create([
        'name' => 'Maharashtra',
        'status' => 'active',
    ]);

    $courseA = CourseDetail::query()->create([
        'couse_name' => 'Filter Target Module',
        'description' => 'Test',
        'active_status' => 1,
    ]);

    $courseB = CourseDetail::query()->create([
        'couse_name' => 'Other Module',
        'description' => 'Test',
        'active_status' => 1,
    ]);

    $council = StateCouncil::query()->create([
        'state_id' => $state->id,
        'council_name' => 'MH Council',
        'active_status' => true,
    ]);
    $council->courseDetails()->attach([$courseA->id, $courseB->id]);

    $learnerA = User::factory()->create([
        'role_type' => 'user',
        'email' => 'filter-target@example.test',
    ]);
    $learnerB = User::factory()->create([
        'role_type' => 'user',
        'email' => 'filter-other@example.test',
    ]);
    $staff = User::factory()->create(['role_type' => 'superadmin']);

    Order::query()->create([
        'user_id' => $learnerA->id,
        'course_detail_id' => $courseA->id,
        'state_council_id' => $council->id,
        'payment_mode' => 'paytm',
        'start_date' => now()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'payment_status' => 'completed',
        'recorded_by_id' => $staff->id,
    ]);

    Order::query()->create([
        'user_id' => $learnerB->id,
        'course_detail_id' => $courseB->id,
        'state_council_id' => $council->id,
        'payment_mode' => 'internet_banking',
        'start_date' => now()->toDateString(),
        'end_date' => now()->addDays(30)->toDateString(),
        'payment_status' => 'pending',
        'recorded_by_id' => $staff->id,
    ]);

    $response = $this->actingAs($staff)->get(route('super-admin.order-details.index', [
        'search' => 'filter-target@example.test',
        'payment_mode' => 'paytm',
        'payment_status' => 'completed',
    ]));

    $response->assertSuccessful();
    $response->assertSee('filter-target@example.test');
    $response->assertDontSee('filter-other@example.test');
});
