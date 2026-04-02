<?php

use App\Http\Controllers\CneModulesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\AdminUserController;
use App\Http\Controllers\SuperAdmin\CourseDetailController;
use App\Http\Controllers\SuperAdmin\CourseMaterialController;
use App\Http\Controllers\SuperAdmin\CourseQuestionController;
use App\Http\Controllers\SuperAdmin\CourseTitleController;
use App\Http\Controllers\SuperAdmin\OrderDetailsController;
use App\Http\Controllers\SuperAdmin\OrderStatusController;
use App\Http\Controllers\SuperAdmin\ReportsController;
use App\Http\Controllers\SuperAdmin\StateController;
use App\Http\Controllers\SuperAdmin\StateCouncilController;
use App\Http\Controllers\SuperAdmin\UsersListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $latestCourses = \App\Models\CourseDetail::where('active_status', 1)
        ->orderByRaw('CASE WHEN sequence IS NULL THEN 1 ELSE 0 END')
        ->orderBy('sequence')
        ->orderBy('id')
        ->get();
    return view('welcome', compact('latestCourses'));
})->name('home');
Route::view('/about-us', 'about')->name('about');
Route::get('/cpd-modules', [CneModulesController::class, 'index'])->name('cne.modules');
Route::get('/cpd-modules/{course_detail:couse_name}', [CneModulesController::class, 'show'])->name('cne.modules.show');
Route::view('/cpd-certifications', 'cpd-certifications')->name('cpd.certifications');
Route::view('/learning-materials', 'learning-materials')->name('learning.materials');
Route::view('/practice-test', 'practice-test')->name('practice.test');
Route::view('/online-examination', 'online-examination')->name('online.examination');

Route::view('/faq', 'faq')->name('faq');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy.policy');
Route::view('/terms-and-conditions', 'terms-and-conditions')->name('terms.conditions');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        if (auth()->user()?->role_type === 'user') {
            return view('profile.frontend');
        }

        return view('pages.profile', ['title' => 'Profile']);
    })->name('profile');

    Route::get('/change-password', function () {
        return view('profile.change-password');
    })->name('profile.change-password');

    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

$prefixes = ['super-admin', 'admin', 'sme', 'support'];

foreach ($prefixes as $prefix) {
    Route::prefix($prefix)->middleware(['auth', 'role:'.$prefix])->group(function () use ($prefix) {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name($prefix.'.dashboard');

        if ($prefix === 'super-admin') {
            Route::middleware('superadmin')->group(function () use ($prefix) {
                Route::resource('users', AdminUserController::class)
                    ->names($prefix.'.admin-users')
                    ->parameters(['users' => 'admin_user']);
            });
        }

        if ($prefix === 'super-admin') {
            Route::resource('course-details', CourseDetailController::class)
                ->names($prefix.'.course-details')
                ->parameters(['course-details' => 'course_detail']);
        } else {
            Route::resource('course-details', CourseDetailController::class)
                ->only(['index'])
                ->names($prefix.'.course-details')
                ->parameters(['course-details' => 'course_detail']);
        }

        if (in_array($prefix, ['super-admin', 'admin'], true)) {
            Route::resource('course-titles', CourseTitleController::class)
                ->names($prefix.'.course-titles')
                ->parameters(['course-titles' => 'course_title']);
        } else {
            Route::resource('course-titles', CourseTitleController::class)
                ->only(['index'])
                ->names($prefix.'.course-titles')
                ->parameters(['course-titles' => 'course_title']);
        }

        if (in_array($prefix, ['super-admin', 'admin'], true)) {
            Route::resource('title-materials', CourseMaterialController::class)
                ->names($prefix.'.title-materials')
                ->parameters(['title-materials' => 'title_material']);
        } else {
            Route::resource('title-materials', CourseMaterialController::class)
                ->only(['index'])
                ->names($prefix.'.title-materials')
                ->parameters(['title-materials' => 'title_material']);
        }

        if (in_array($prefix, ['admin', 'sme'], true)) {
            Route::resource('course-questions', CourseQuestionController::class)
                ->names($prefix.'.course-questions')
                ->parameters(['course-questions' => 'course_question']);
        } else {
            Route::resource('course-questions', CourseQuestionController::class)
                ->only(['index'])
                ->names($prefix.'.course-questions')
                ->parameters(['course-questions' => 'course_question']);
        }

        if (in_array($prefix, ['super-admin', 'admin'], true)) {
            Route::resource('states', StateController::class)
                ->except(['show'])
                ->names($prefix.'.states')
                ->parameters(['states' => 'state']);
            Route::get('state-councils/state-wise-modules', [StateCouncilController::class, 'stateWiseModules'])
                ->name($prefix.'.state-councils.state-wise-modules');
            Route::get('state-councils/state-wise-pass-percentage', [StateCouncilController::class, 'stateWisePassPercentage'])
                ->name($prefix.'.state-councils.state-wise-pass-percentage');
            Route::resource('state-councils', StateCouncilController::class)
                ->except(['index', 'show'])
                ->names($prefix.'.state-councils')
                ->parameters(['state-councils' => 'state_council']);
        }

        if (in_array($prefix, ['super-admin', 'admin', 'support'], true)) {
            Route::get('users-list', [UsersListController::class, 'index'])
                ->name($prefix.'.users-list.index');
        }

        if (in_array($prefix, ['super-admin', 'admin'], true)) {
            Route::get('reports', [ReportsController::class, 'index'])
                ->name($prefix.'.reports.index');
        }

        if (in_array($prefix, ['super-admin', 'admin', 'support'], true)) {
            Route::get('order-details', [OrderDetailsController::class, 'index'])
                ->name($prefix.'.order-details.index');
        }

        if (in_array($prefix, ['super-admin', 'admin'], true)) {
            Route::get('order-status', [OrderStatusController::class, 'index'])
                ->name($prefix.'.order-status.index');
        }
    });
}

require __DIR__.'/auth.php';
