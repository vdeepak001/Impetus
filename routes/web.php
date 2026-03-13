<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('pages.profile', ['title' => 'Profile']);
    })->name('profile');
    
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Super Admin Routes
Route::prefix('super-admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('super-admin.dashboard');

    // Admin Users Resource
    Route::resource('users', \App\Http\Controllers\SuperAdmin\AdminUserController::class)
        ->names('admin-users')
        ->parameters(['users' => 'admin_user']);

    // Course Details Resource
    Route::resource('course-details', \App\Http\Controllers\SuperAdmin\CourseDetailController::class)
        ->names('course-details')
        ->parameters(['course-details' => 'course_detail']);

    // Course Titles Resource
    Route::resource('course-titles', \App\Http\Controllers\SuperAdmin\CourseTitleController::class)
        ->names('course-titles')
        ->parameters(['course-titles' => 'course_title']);

    // Course Materials Resource
    Route::resource('title-materials', \App\Http\Controllers\SuperAdmin\CourseMaterialController::class)
        ->names('title-materials')
        ->parameters(['title-materials' => 'title_material']);

    // Course Questions Resource
    Route::resource('course-questions', \App\Http\Controllers\SuperAdmin\CourseQuestionController::class)
        ->names('course-questions')
        ->parameters(['course-questions' => 'course_question']);
});

require __DIR__.'/auth.php';
