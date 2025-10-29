<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TaskController;


Route::prefix('admin')->name('admin.')->middleware('auth', 'is_admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Team Controller 

    Route::resource('team', TeamController::class);

    // User Controller 

    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::put('select_user/{id}', [AdminController::class, 'select_user'])->name('select_user');

    // Task Controller 

    Route::resource('task', TaskController::class);

    // Profile Page

    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile_data', [AdminController::class, 'profile_data'])->name('profile_data');
    Route::post('check-password', [AdminController::class, 'check_password'])
    ->name('check_password');
});
