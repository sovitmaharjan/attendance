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
        $next_id = User::orderBy('id', 'desc')->first() != false ? User::orderBy('id', 'desc')->first()->id + 1 : 1;
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

if (!function_exists('getDays')) {
    function getDays()
    {
        $arr = [
            'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
        ];

        return (object)$arr;
    }
}
if (!function_exists('statusTitle')) {
    function statusTitle($status)
    {
        return $status == 1 ? 'Active' : 'Inactive';
    }
}

if (!function_exists('getUser')){
    function getUser(){
        return \Illuminate\Support\Facades\Auth::user();
    }
}
