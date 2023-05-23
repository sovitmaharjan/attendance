<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForceAttendanceController;
use App\Http\Controllers\LeaveApplicationController;
use App\Http\Controllers\LeaveAssignmentController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth', 'prefix' => 'ajax', 'as' => 'ajax.'], function () {
    Route::get('/branch/{branch}', [BranchController::class, 'show'])->name('branch.show');
    Route::get('/department/{department}', [DepartmentController::class, 'show'])->name('department.show');
    Route::get('/employee/{employee}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('/leave/{leave}', [LeaveController::class, 'show'])->name('leave.show');
    
    Route::get('/get-employee-work-schedule', [ForceAttendanceController::class, 'getEmployeeWorkSchedule'])->name('get-employee-work-schedule');

    Route::post('/get-leave-data', [LeaveAssignmentController::class, 'getLeaveData'])->name('get-leave-data');
    Route::post('/get-leave-application-data', [LeaveApplicationController::class, 'getLeaveApplicationData'])->name('get-leave-application-data');
    Route::post('/check-leave-application-date', [LeaveApplicationController::class, 'checkLeaveApplicationDate'])->name('check-leave-application-date');
});
