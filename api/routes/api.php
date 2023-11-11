<?php

use App\Http\Controllers\Api\ExpensesController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('auth.login');
    Route::post('sign-up', 'signUp')->name('auth.sign-up');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::post('forgot-password', 'forgotPassword')->name('auth.forgot-password');
        Route::post('reset-password', 'resetPassword')->name('auth.reset-password');
    });

    Route::apiResource('users', UsersController::class);
    Route::apiResource('expenses', ExpensesController::class);

    // Route::prefix('devices')->group(function () {
    //     Route::get('', 'index')->name('devices.index');
    //     Route::post('logout', 'logoutDevice')->name('devices.logout');
    //     Route::post('logout-all', 'logoutAllDevices')->name('devices.logout-all');
    // });
});
