<?php

use App\Models\CourseDetail;
use App\Models\User;

it('returns a successful response for the CNE modules listing', function () {
    $response = $this->get(route('cne.modules'));

    $response->assertSuccessful();
    $response->assertSee('CPD Modules', false);
    $response->assertSee('Continuing Professional Development Modules', false);
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
