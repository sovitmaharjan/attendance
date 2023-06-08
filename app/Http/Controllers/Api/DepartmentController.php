<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function show(Department $department)
    {
        return responseSuccess(new DepartmentResource($department->load('employees')), 'Department', 200);
    }
}
