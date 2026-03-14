<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\AdminUserController;
use App\Http\Controllers\SuperAdmin\CourseDetailController;
use App\Http\Controllers\SuperAdmin\CourseMaterialController;
use App\Http\Controllers\SuperAdmin\CourseQuestionController;
use App\Http\Controllers\SuperAdmin\CourseTitleController;
use App\Http\Controllers\SuperAdmin\OrderDetailsController;
use App\Http\Controllers\SuperAdmin\OrderStatusController;
use App\Http\Controllers\SuperAdmin\ReportsController;
use App\Http\Controllers\SuperAdmin\StateCouncilController;
use App\Http\Controllers\SuperAdmin\UsersListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('pages.profile', ['title' => 'Profile']);
    })->name('profile');

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

        Route::resource('course-details', CourseDetailController::class)
            ->names($prefix.'.course-details')
            ->parameters(['course-details' => 'course_detail']);

        Route::resource('course-titles', CourseTitleController::class)
            ->names($prefix.'.course-titles')
            ->parameters(['course-titles' => 'course_title']);

        Route::resource('title-materials', CourseMaterialController::class)
            ->names($prefix.'.title-materials')
            ->parameters(['title-materials' => 'title_material']);

        Route::resource('course-questions', CourseQuestionController::class)
            ->names($prefix.'.course-questions')
            ->parameters(['course-questions' => 'course_question']);

        if (in_array($prefix, ['super-admin', 'admin'], true)) {
            Route::get('state-councils/state-wise-modules', [StateCouncilController::class, 'stateWiseModules'])
                ->name($prefix.'.state-councils.state-wise-modules');
            Route::get('state-councils/state-wise-pass-percentage', [StateCouncilController::class, 'stateWisePassPercentage'])
                ->name($prefix.'.state-councils.state-wise-pass-percentage');
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
