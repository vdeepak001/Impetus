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
});

// Super Admin Users Routes
Route::resource('super-admin/users', \App\Http\Controllers\SuperAdmin\AdminUserController::class)
    ->middleware(['auth'])
    ->names('admin-users')
    ->parameters(['users' => 'admin_user']);

require __DIR__.'/auth.php';
