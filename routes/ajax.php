<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForceAttendanceController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth', 'prefix' => 'ajax', 'as' => 'ajax.'], function () {
    Route::get('/branch/{branch}', [BranchController::class, 'show'])->name('branch.show');
    Route::get('/department/{department}', [DepartmentController::class, 'show'])->name('department.show');
    Route::get('/employee/{employee}', [EmployeeController::class, 'show'])->name('employee.show');
    Route::get('/leave/{leave}', [LeaveController::class, 'show'])->name('leave.show');
    
    Route::get('/getEmployeeShift', [ForceAttendanceController::class, 'getEmployeeShift'])->name('get-employee-shift');
});
