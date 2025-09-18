<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\UserAuthController;
use App\Http\Controllers\Api\Auth\AdminAuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/user/register', [UserAuthController::class, 'register'])->name('userregister');
Route::post('/user/login', [UserAuthController::class, 'login'])->name('userlogin');

Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('adminregister');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('adminlogin');

// Protected example routes
Route::middleware(['auth:user', 'role:basic-user'])->group(function () {
    Route::get('/user/profile', function () {
        return auth('user')->user();
    });
});

Route::middleware(['auth:admin', 'role:super-admin'])->group(function () {
    Route::get('/admin/profile', function () {
        return auth('admin')->user();
    });
});
