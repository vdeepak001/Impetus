<?php

use App\Models\CourseDetail;
use App\Models\CourseMaterial;
use App\Models\CourseTitle;
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

it('shows learning materials subtitle and original file names on course detail page', function () {
    $course = CourseDetail::create([
        'couse_name' => 'Critical Care',
        'description' => 'Course content',
        'active_status' => 1,
    ]);

    $courseTitle = CourseTitle::create([
        'course_id' => $course->id,
        'title_name' => 'Emergency Management',
        'active_status' => true,
    ]);

    CourseMaterial::create([
        'course_id' => $course->id,
        'course_title_id' => $courseTitle->id,
        'description' => 'Week 1 Slides',
        'attachment' => ['materials/1711111111_sample-guide.pdf', 'materials/1711111112_care-plan.pptx'],
        'active_status' => true,
    ]);

    $response = $this->get(route('cne.modules.show', $course));

    $response->assertSuccessful();
    $response->assertSee('View Learning Materials', false);
    $response->assertDontSee('sample-guide.pdf', false);

    $materialsPageResponse = $this->get(route('cne.modules.materials', $course));
    $materialsPageResponse->assertSuccessful();
    $materialsPageResponse->assertSee('Learning Materials', false);
    $materialsPageResponse->assertSee('Emergency Management', false);
    $materialsPageResponse->assertSee('sample-guide.pdf', false);
    $materialsPageResponse->assertSee('care-plan.pptx', false);
    $materialsPageResponse->assertDontSee('Week 1 Slides', false);
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
