<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth', 'as' => 'api.'], function () {
    Route::get('api/branch/{branch_id}', function ($branch_id) {
        return getBranchDetails($branch_id);
    })->name('branch.show');

    Route::get('api/department/{department_id}', function ($department_id) {
        return getDepartmentDetails($department_id);
    })->name('department.show');

    Route::get('api/employee/{employee_id}', function ($employee_id) {
        return getEmployeeDetails($employee_id);
    })->name('employee.show');
    
    Route::get('/api/getEmployeeShift', [ForceAttendanceController::class, 'getEmployeeShift'])->name('get-employee-shift');
});
