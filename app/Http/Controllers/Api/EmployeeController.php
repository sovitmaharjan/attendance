<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\User;

class EmployeeController extends Controller
{
    public function show(User $employee)
    {
        return responseSuccess(new EmployeeResource($employee), 'Employee', 200);
    }
}
