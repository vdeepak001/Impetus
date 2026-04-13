<?php

use App\Models\CourseDetail;
use App\Models\State;
use App\Models\StateCouncil;
use App\Models\User;

it('returns a successful response for the CNE modules listing', function () {
    $response = $this->get(route('cne.modules'));

    $response->assertSuccessful();
    $response->assertSee('CPD Modules', false);
    $response->assertSee('Continuing Professional Development Modules', false);
});

it('lists active courses with static course card imagery and course titles', function () {
    CourseDetail::create([
        'couse_name' => 'Listing Test Course',
        'description' => 'Test description for listing.',
        'active_status' => 1,
    ]);

    $response = $this->get(route('cne.modules'));

    $response->assertSuccessful();
    $response->assertSee('images/course.jpeg', false);
    $response->assertSee('Listing Test Course', false);
});

it('shows only state council assigned courses for authenticated frontend users', function () {
    $mp = State::query()->create([
        'name' => 'Madhya Pradesh',
        'status' => 'active',
    ]);

    $tn = State::query()->create([
        'name' => 'Tamil Nadu',
        'status' => 'active',
    ]);

    $mpCourse = CourseDetail::create([
        'couse_name' => 'MP Course',
        'description' => 'Test',
        'active_status' => 1,
        'sequence' => 1,
    ]);

    $tnCourse = CourseDetail::create([
        'couse_name' => 'TN Course',
        'description' => 'Test',
        'active_status' => 1,
        'sequence' => 2,
    ]);

    $mpCouncil = StateCouncil::query()->create([
        'state_id' => $mp->id,
        'council_name' => 'MP Nursing Council',
        'active_status' => true,
    ]);
    $mpCouncil->courseDetails()->attach($mpCourse->id);

    $tnCouncil = StateCouncil::query()->create([
        'state_id' => $tn->id,
        'council_name' => 'TN Nursing Council',
        'active_status' => true,
    ]);
    $tnCouncil->courseDetails()->attach($tnCourse->id);

    $user = User::factory()->create([
        'role_type' => 'user',
        'state' => 'Madhya Pradesh',
    ]);

    $response = $this->actingAs($user)->get(route('cne.modules'));

    $response->assertSuccessful();
    $response->assertSee('MP Course', false);
    $response->assertDontSee('TN Course', false);
});

it('shows an active course detail page with module content', function () {
    $course = CourseDetail::create([
        'couse_name' => 'First Aid',
        'description' => "Learn emergency basics.\n\nStay confident in care.",
        'qa_content' => 'Questions and answers for deeper learning.',
        'practice_content' => 'Level I–III multiple choice practice.',
        'active_status' => 1,
        'sequence' => 1,
    ]);

    $response = $this->get(route('cne.modules.show', $course));

    $response->assertSuccessful();
    $response->assertSee('First Aid', false);
    $response->assertSee('What you will learn in First Aid?', false);
    $response->assertSee('Learning resources', false);
    $response->assertSee('Practice test', false);
    $response->assertSee('Questions and answers for deeper learning', false);
    $response->assertSee('Buy now', false);
});

it('returns not found for inactive course detail', function () {
    $course = CourseDetail::create([
        'couse_name' => 'Hidden',
        'active_status' => 0,
    ]);

    $this->get(route('cne.modules.show', $course))->assertNotFound();
});

it('shows buy now as login trigger for guests even without a purchase url', function () {
    $course = CourseDetail::create([
        'couse_name' => 'Purchasable',
        'description' => 'Test',
        'active_status' => 1,
    ]);

    $response = $this->get(route('cne.modules.show', $course));

    $response->assertSuccessful();
    $response->assertSee('Buy now', false);
    $response->assertSee('open-login-modal', false);
});

it('shows buy now as disabled for authenticated users when course has no purchase url', function () {
    $user = User::factory()->create(['role_type' => 'user']);

    $course = CourseDetail::create([
        'couse_name' => 'No URL',
        'description' => 'Test',
        'active_status' => 1,
    ]);

    $response = $this->actingAs($user)->get(route('cne.modules.show', $course));

    $response->assertSuccessful();
    $response->assertSee('Buy now', false);
    $response->assertSee('disabled', false);
});

it('shows buy now as external link for authenticated users when course has a purchase url', function () {
    $user = User::factory()->create(['role_type' => 'user']);

    $course = CourseDetail::create([
        'couse_name' => 'Purchasable',
        'description' => 'Test',
        'course_url' => 'https://example.com/purchase',
        'active_status' => 1,
    ]);

    $response = $this->actingAs($user)->get(route('cne.modules.show', $course));

    $response->assertSuccessful();
    $response->assertSee('https://example.com/purchase', false);
});
