<?php

use App\Models\CourseDetail;
use App\Models\CourseTitle;
use App\Models\User;

test('admin can create multiple course sub titles in a single request', function () {
    $admin = User::factory()->create(['role_type' => 'admin']);
    $course = CourseDetail::create([
        'couse_name' => 'CPD Basics',
        'course_code' => 'CPD-101',
    ]);

    $response = $this->actingAs($admin)->post(route('admin.course-sub-titles.store'), [
        'course_id' => $course->id,
        'title_name' => ['Introduction', 'Advanced Topics'],
    ]);

    $response->assertRedirect(route('admin.course-sub-titles.index'));

    $this->assertDatabaseHas('course_title', [
        'course_id' => $course->id,
        'title_name' => 'Introduction | Advanced Topics',
    ]);
});

test('admin update stores grouped sub titles in the same row', function () {
    $admin = User::factory()->create(['role_type' => 'admin']);
    $course = CourseDetail::create([
        'couse_name' => 'Emergency Care',
        'course_code' => 'CPD-202',
    ]);
    $existingSubTitle = CourseTitle::create([
        'course_id' => $course->id,
        'title_name' => 'Old Name',
        'user_id' => $admin->id,
    ]);

    $response = $this->actingAs($admin)->put(route('admin.course-sub-titles.update', $existingSubTitle), [
        'course_id' => $course->id,
        'title_name' => ['Updated Name', 'New Extra Sub Title'],
    ]);

    $response->assertRedirect(route('admin.course-sub-titles.index'));

    expect($existingSubTitle->fresh()->title_name)->toBe('Updated Name | New Extra Sub Title');
});
