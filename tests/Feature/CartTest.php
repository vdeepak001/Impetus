<?php

use App\Models\CartItem;
use App\Models\CourseDetail;
use App\Models\State;
use App\Models\StateCouncil;
use App\Models\User;

it('allows frontend user to add a state assigned module to cart', function () {
    $state = State::query()->create([
        'name' => 'Madhya Pradesh',
        'status' => 'active',
    ]);

    $course = CourseDetail::create([
        'couse_name' => 'Assigned Course',
        'description' => 'Test',
        'active_status' => 1,
        'sequence' => 1,
    ]);

    $council = StateCouncil::query()->create([
        'state_id' => $state->id,
        'council_name' => 'MP Nursing Council',
        'active_status' => true,
    ]);

    $council->courseDetails()->attach($course->id, [
        'mrp' => [500],
        'offer_price' => [450],
        'valid_days' => [20],
        'pass_percentage' => [60],
        'points' => [6],
    ]);

    $user = User::factory()->create([
        'role_type' => 'user',
        'state' => 'Madhya Pradesh',
    ]);

    $response = $this->actingAs($user)->post(route('cart.items.store', $course->couse_name));

    $response->assertRedirect(route('cart.index'));

    $item = CartItem::query()->where('user_id', $user->id)->where('course_detail_id', $course->id)->first();

    expect($item)->not->toBeNull()
        ->and($item->state_council_id)->toBe($council->id)
        ->and($item->mrp)->toBe(500)
        ->and($item->offer_price)->toBe(450)
        ->and($item->valid_days)->toBe(20)
        ->and($item->pass_percentage)->toBe(60)
        ->and($item->points)->toBe(6);
});

it('prevents frontend user from adding a module that is not assigned to their state', function () {
    State::query()->create([
        'name' => 'Madhya Pradesh',
        'status' => 'active',
    ]);

    $otherState = State::query()->create([
        'name' => 'Tamil Nadu',
        'status' => 'active',
    ]);

    $course = CourseDetail::create([
        'couse_name' => 'TN Only Course',
        'description' => 'Test',
        'active_status' => 1,
    ]);

    $tnCouncil = StateCouncil::query()->create([
        'state_id' => $otherState->id,
        'council_name' => 'TN Nursing Council',
        'active_status' => true,
    ]);
    $tnCouncil->courseDetails()->attach($course->id);

    $user = User::factory()->create([
        'role_type' => 'user',
        'state' => 'Madhya Pradesh',
    ]);

    $response = $this->actingAs($user)->post(route('cart.items.store', $course->couse_name));

    $response->assertStatus(302);
    $response->assertSessionHas('error');

    expect(CartItem::query()->count())->toBe(0);
});

it('allows frontend user to remove module from cart', function () {
    $state = State::query()->create([
        'name' => 'Madhya Pradesh',
        'status' => 'active',
    ]);

    $course = CourseDetail::create([
        'couse_name' => 'Assigned Course',
        'description' => 'Test',
        'active_status' => 1,
    ]);

    $council = StateCouncil::query()->create([
        'state_id' => $state->id,
        'council_name' => 'MP Nursing Council',
        'active_status' => true,
    ]);
    $council->courseDetails()->attach($course->id);

    $user = User::factory()->create([
        'role_type' => 'user',
        'state' => 'Madhya Pradesh',
    ]);

    CartItem::query()->create([
        'user_id' => $user->id,
        'course_detail_id' => $course->id,
        'state_council_id' => $council->id,
    ]);

    $response = $this->actingAs($user)->delete(route('cart.items.destroy', $course->couse_name));

    $response->assertStatus(302);
    expect(CartItem::query()->count())->toBe(0);
});
