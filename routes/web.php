<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return bcrypt('123456');
});

Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('admin.login');
    Route::post('login', [AuthController::class, 'admin_login']);
    Route::post('logout', [AuthController::class, 'admin_logout'])->name('admin_logout');

    Route::middleware(AdminAuth::class)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('admin.dashboard');
    });
});
