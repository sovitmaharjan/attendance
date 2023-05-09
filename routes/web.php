<?php

use App\Http\Controllers\AttendanceReportController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DynamicValuesController;
use App\Http\Controllers\ForceAttendanceController;
use App\Http\Controllers\LeaveApplicationController;
use App\Http\Controllers\LeaveAssignmentController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\EventAssignmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ShiftAssignmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeSubstituteDayController;
use App\Http\Controllers\LeaveBalanceController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\WorkScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetPasswordMail'])->name('reset-password-mail');
Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/permission-group', PermissionGroupController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);

    Route::resource('company', SiteSettingController::class)->only('index', 'store');
    Route::resource('branch', BranchController::class)->except('show');
    Route::resource('department', DepartmentController::class)->except('show');
    Route::resource('designation', DesignationController::class)->except('show');

    Route::resource('/employee', EmployeeController::class)->except('show'); //->middleware(['checkPermission:delete-dashboard'])
    Route::resource('/event', EventController::class);
    Route::resource('/holiday', HolidayController::class);
    Route::resource('/shift', ShiftController::class);
    Route::resource('/work-schedule', WorkScheduleController::class);
    Route::resource('/shift-assignment', ShiftAssignmentController::class)->only('index', 'store');
    Route::resource('/force-attendance', ForceAttendanceController::class)->only('index', 'store');
    Route::resource('/leave', LeaveController::class)->except('show');
    Route::resource('/leave-assignment', LeaveAssignmentController::class)->only('index', 'store');
    Route::resource('/leave-application', LeaveApplicationController::class)->only('index', 'create', 'store', 'destroy');
    Route::patch('/leave-application/{id}/approve', [LeaveApplicationController::class, 'approve'])->name('leave-application.approve');
    Route::patch('/leave-application/{id}/cancel', [LeaveApplicationController::class, 'cancel'])->name('leave-application.cancel');

    Route::group(['prefix' => 'dynamic-values', 'as' => "dynamic_values."], function () {
        Route::get('/{setup}', [DynamicValuesController::class, 'getValues'])->name('index');
        Route::post('/save', [DynamicValuesController::class, 'save'])->name('save');
        Route::get('get/{id}', [DynamicValuesController::class, 'edit'])->name('edit');
    });

    Route::get('department/off/days/{id}', [DepartmentController::class, 'departmentOffDays'])->name('departmentOffDays');
    Route::post('department/off/days', [DepartmentController::class, 'assingOffDays'])->name('assignOffDays');

    Route::group(['prefix' => 'event-assignment', 'as' => 'event-assignment.'], function () {
        Route::get('/{event_id?}', [EventAssignmentController::class, 'index'])->name('index');
        Route::post('store', [EventAssignmentController::class, 'store'])->name('store');
        Route::get('employee/{event_id}', [EventAssignmentController::class, 'event_employee_list'])->name('event_employee_list');
    });

    Route::post('employee-substitute-day', [EmployeeSubstituteDayController::class, 'store'])->name('subsituteDay');

    // report
    Route::match(['get', 'post'], '/quick-attendance', [AttendanceReportController::class, 'quickAttendanceReport'])->name('quick-attendance');
    Route::match(['get', 'post'], '/monthly-attendance', [AttendanceReportController::class, 'monthlyAttendanceReport'])->name('monthly-attendance');
    Route::match(['get', 'post'], '/leave-balance', [LeaveBalanceController::class, 'index'])->name('leave-balance.index');
});
