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
});

require __DIR__.'/auth.php';
