<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetPasswordMail'])->name('reset-password-mail');
Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password');
// Route::post('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group([
    'middleware' => [
        'auth'
    ]
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/permission-group', PermissionGroupController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', PermissionController::class);
    Route::resource('/company', PermissionController::class);
    Route::resource('/branch', PermissionController::class);
    Route::resource('/department', PermissionController::class);
    Route::resource('/employee', EmployeeController::class);
});