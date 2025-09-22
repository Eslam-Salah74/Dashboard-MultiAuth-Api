<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\UserAuthController;
use App\Http\Controllers\Api\Auth\AdminAuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('user')->group(
    function () {
        Route::post('/register', [UserAuthController::class, 'register'])->name('userregister');
        Route::post('/login', [UserAuthController::class, 'login'])->name('userlogin');
    }
);


Route::prefix('admin')->group(function () {
    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');
});


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
