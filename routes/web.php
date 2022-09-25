<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HolidayTypeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DynamicValuesController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index']);
// duita name login vayara maila  hatako hoi yo mathi ko chai
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetPasswordMail'])->name('reset-password-mail');
Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password');
// Route::post('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/permission-group', PermissionGroupController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);

    Route::resource('/employee', EmployeeController::class);
    Route::resource('/holiday-type', HolidayTypeController::class);
    Route::resource('/holiday', HolidayController::class);
    Route::resource('/shift', ShiftController::class);

    Route::group(['prefix' => 'dynamic-values', 'as' => "dynamic_values."], function(){
       Route::get('/{setup}', [DynamicValuesController::class, 'getValues'])->name('index');
       Route::post('/save', [DynamicValuesController::class, 'save'])->name('save');
       Route::get('get/{id}', [DynamicValuesController::class, 'edit'])->name('edit');
    });
});


include(__DIR__.'/Routes/company.php');
