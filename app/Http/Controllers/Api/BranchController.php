<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;
use App\Models\Branch;

class BranchController extends Controller
{
    public function show(Branch $branch)
    {
        return responseSuccess(new BranchResource($branch->load('departments', 'employees')), 'Branche', 200);
    }
}
