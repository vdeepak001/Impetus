<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CneModulesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\AdminUserController;
use App\Http\Controllers\SuperAdmin\CourseDetailController;
use App\Http\Controllers\SuperAdmin\CourseMaterialController;
use App\Http\Controllers\SuperAdmin\CourseQuestionController;
use App\Http\Controllers\SuperAdmin\CourseSubTitleController;
use App\Http\Controllers\SuperAdmin\CourseTitleController;
use App\Http\Controllers\SuperAdmin\LevelScoreController;
use App\Http\Controllers\SuperAdmin\OrderDetailsController;
use App\Http\Controllers\SuperAdmin\OrderStatusController;
use App\Http\Controllers\SuperAdmin\ReportsController;
use App\Http\Controllers\SuperAdmin\StateController;
use App\Http\Controllers\SuperAdmin\StateCouncilController;
use App\Http\Controllers\SuperAdmin\UserCourseOrderController;
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
Route::get('/cpd-modules/{course_detail:couse_name}/learning-materials', [CneModulesController::class, 'materials'])->name('cne.modules.materials');
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
            $purchasedCourses = \App\Models\Order::query()
                ->with('courseDetail:id,couse_name')
                ->where('user_id', auth()->id())
                ->where('payment_status', \App\Enums\PaymentStatus::Completed)
                ->latest('id')
                ->get();

            return view('profile.frontend', [
                'purchasedCourses' => $purchasedCourses,
            ]);
        }

        return view('pages.profile', ['title' => 'Profile']);
    })->name('profile');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/items/{course_detail:couse_name}', [CartController::class, 'store'])->name('cart.items.store');
    Route::delete('/cart/items/{course_detail:couse_name}', [CartController::class, 'destroy'])->name('cart.items.destroy');

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
            // Course Title (Basic Info) - Super Admin ONLY Add/Edit
            Route::resource('course-titles', CourseTitleController::class)
                ->names($prefix.'.course-titles')
                ->parameters(['course-titles' => 'course_title']);

            // Course Details (Extended Info) - Super Admin View Only
            Route::resource('course-details', CourseDetailController::class)
                ->only(['index'])
                ->names($prefix.'.course-details')
                ->parameters(['course-details' => 'course_detail']);

            // Course Sub-titles - Super Admin View Only
            Route::resource('course-sub-titles', CourseSubTitleController::class)
                ->only(['index'])
                ->names($prefix.'.course-sub-titles')
                ->parameters(['course-sub-titles' => 'course_sub_title']);
        } elseif ($prefix === 'admin') {
            // Course Title (Basic Info) - Admin View Only
            Route::resource('course-titles', CourseTitleController::class)
                ->only(['index'])
                ->names($prefix.'.course-titles')
                ->parameters(['course-titles' => 'course_title']);

            // Course Details (Extended Info) - Admin ONLY Edit/Update
            Route::resource('course-details', CourseDetailController::class)
                ->except(['create', 'store'])
                ->names($prefix.'.course-details')
                ->parameters(['course-details' => 'course_detail']);

            // Course Sub-titles - Admin ONLY Add/Edit
            Route::resource('course-sub-titles', CourseSubTitleController::class)
                ->names($prefix.'.course-sub-titles')
                ->parameters(['course-sub-titles' => 'course_sub_title']);
        } else {
            // Other roles (sme, support) - view only or subset
            Route::resource('course-details', CourseDetailController::class)
                ->only(['index'])
                ->names($prefix.'.course-details')
                ->parameters(['course-details' => 'course_detail']);
                
            Route::resource('course-sub-titles', CourseSubTitleController::class)
                ->only(['index'])
                ->names($prefix.'.course-sub-titles')
                ->parameters(['course-sub-titles' => 'course_sub_title']);
        }

        if (!in_array($prefix, ['super-admin'], true)) {
            Route::resource('course-titles', CourseTitleController::class)
                ->only(['index'])
                ->names($prefix.'.course-titles')
                ->parameters(['course-titles' => 'course_title']);
        }

        if (in_array($prefix, ['super-admin', 'admin'], true)) {
            Route::get('title-materials/get-existing-attachments', [CourseMaterialController::class, 'getExistingAttachments'])
                ->name($prefix.'.title-materials.get-existing-attachments');
                
            Route::resource('title-materials', CourseMaterialController::class)
                ->names($prefix.'.title-materials')
                ->parameters(['title-materials' => 'title_material']);

            Route::get('level-scores', [LevelScoreController::class, 'index'])
                ->name($prefix.'.level-scores.index');
            Route::post('level-scores', [LevelScoreController::class, 'store'])
                ->name($prefix.'.level-scores.store');
        } else {
            Route::resource('title-materials', CourseMaterialController::class)
                ->only(['index'])
                ->names($prefix.'.title-materials')
                ->parameters(['title-materials' => 'title_material']);

            Route::get('level-scores', [LevelScoreController::class, 'index'])
                ->name($prefix.'.level-scores.index');
        }

        if (in_array($prefix, ['super-admin', 'admin', 'sme'], true)) {
            Route::get('course-questions/get-next-code', [CourseQuestionController::class, 'getNextCode'])
                ->name($prefix.'.course-questions.get-next-code');
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
            Route::get('users-list/{userId}/state-courses', [UserCourseOrderController::class, 'courses'])
                ->whereNumber('userId')
                ->name($prefix.'.users-list.state-courses');
            Route::post('users-list/{userId}/orders', [UserCourseOrderController::class, 'store'])
                ->whereNumber('userId')
                ->name($prefix.'.users-list.orders.store');
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
