<?php

use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\DynamicValue;
use App\Models\User;

if (!function_exists('getDynamicValues')) {
    function getDynamicValues($key)
    {
        return DynamicValue::where('key', $key)->get();
    }
}

if (!function_exists('getGenders')) {
    function getGenders()
    {
        $arr = [
            [
                'name' => "Male",
                "value" => "Male",
            ],
            [
                'name' => "Female",
                "value" => "Female",
            ],
            [
                'name' => "Other",
                "value" => "Other",
            ],
        ];
        return json_decode(json_encode($arr));
    }
}

if (!function_exists('generateLoginId')) {
    function generateLoginId($company_id)
    {
        $next_id = User::latest()->first() != false ? User::latest()->first()->id + 1 : 1;
        $login_id = Company::find($company_id)->code . '-' . $next_id;
        return $login_id;
    }
}

if (!function_exists('getFormattedDate')) {
    function getFormattedDate($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    
}

function getBranchDetails($branch_id)
{
    $data = Branch::find($branch_id)->load('departments', 'employees');
    if ($data->company_id != auth()->user()->company_id) {
        return 'This branch doesnot exist or belongs to other company';
    }
    return response()->json($data);
}

function getDepartmentDetails($department_id)
{
    $data = Department::find($department_id)->load('branch', 'employees');
    if ($data->company_id != auth()->user()->company_id) {
        return 'This department doesnot exist or belongs to other company';
    }
    return response()->json($data);
}

function getEmployeeDetails($employee_id)
{
    $data = User::find($employee_id)->load('branch', 'department');
    if ($data->company_id != auth()->user()->company_id) {
        return 'This employee doesnot exist or belongs to other company';
    }
    return response()->json($data);
}
