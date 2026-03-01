<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HistoryController as AdminHistoryController;
use App\Http\Controllers\Admin\MasterGameController;
use App\Http\Controllers\Admin\MasterUserController;
use App\Http\Controllers\Admin\MasterVoucherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\HistoryController as UserHistoryController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;


// Global (Admin & User)
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'user_register']);
Route::get('login', [AuthController::class, 'index_user'])->name('login');
Route::post('login', [AuthController::class, 'user_login']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/game/{id}/{slug}', [HomeController::class, 'detail'])->name('game_detail');

// User
Route::middleware('auth')->group(function(){
    // Payment (/payment)
    Route::prefix('payment')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('user.payment.index');
        Route::get('detail/{payment?}', [PaymentController::class, 'detail'])->name('user.payment.detail');

        Route::post('list', [PaymentController::class, 'list'])->name('user.payment.list');
        Route::post('create', [PaymentController::class, 'create'])->name('user.payment.create');
        Route::post('verification', [PaymentController::class, 'verification'])->name('user.payment.verification');
        Route::post('cancel', [PaymentController::class, 'cancel'])->name('user.payment.cancel');
    });
    
    // History Transaksi (/history)
    Route::get('history', [UserHistoryController::class, 'index'])->name('user.history.index');
    Route::post('history', [UserHistoryController::class, 'data'])->name('user.history.data');
    
    // Profile (/profile)
    Route::get('profile', [ProfileController::class, 'index'])->name('user.profile.index');
    Route::post('profile', [ProfileController::class, 'update'])->name('user.profile.update');
});

// Admin
Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'index_admin'])->name('admin.login');
    Route::post('login', [AuthController::class, 'admin_login']);

    Route::middleware(AdminAuth::class)->group(function () {
        // Dashboard (/admin)
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        Route::post('/', [DashboardController::class, 'data'])->name('admin.dashboard.data');
        
        // Dashboard (/admin/transaksi)
        Route::get('transaksi', [AdminHistoryController::class, 'index'])->name('admin.transaksi.index');
        Route::post('transaksi', [AdminHistoryController::class, 'data'])->name('admin.transaksi.data');

        // Master
        Route::prefix('master')->group(function(){
            // Master game ('/admin/master/game')
            Route::prefix('game')->group(function(){
                Route::get('/', [MasterGameController::class, 'index'])->name('admin.master_game.index');
                Route::post('list', [MasterGameController::class, 'list'])->name('admin.master_game.list');
                Route::post('create', [MasterGameController::class, 'create'])->name('admin.master_game.create');
                Route::post('update', [MasterGameController::class, 'update'])->name('admin.master_game.update');
                Route::post('delete', [MasterGameController::class, 'delete'])->name('admin.master_game.delete');
            });

            // Master voucher ('/admin/master/voucher')
            Route::prefix('voucher')->group(function(){
                Route::get('/', [MasterVoucherController::class, 'index'])->name('admin.master_voucher.index');
                Route::post('list', [MasterVoucherController::class, 'list'])->name('admin.master_voucher.list');
                Route::post('create', [MasterVoucherController::class, 'create'])->name('admin.master_voucher.create');
                Route::post('update', [MasterVoucherController::class, 'update'])->name('admin.master_voucher.update');
                Route::post('delete', [MasterVoucherController::class, 'delete'])->name('admin.master_voucher.delete');
            });

            // Master user ('/admin/master/user')
            Route::prefix('user')->group(function(){
                Route::get('/', [MasterUserController::class, 'index'])->name('admin.master_user.index');
                Route::post('list', [MasterUserController::class, 'list'])->name('admin.master_user.list');
                Route::post('create', [MasterUserController::class, 'create'])->name('admin.master_user.create');
                Route::post('update', [MasterUserController::class, 'update'])->name('admin.master_user.update');
                Route::post('delete', [MasterUserController::class, 'delete'])->name('admin.master_user.delete');
            });
        });
    });
});
