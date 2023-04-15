<?php

use App\Models\DynamicValue;
use App\Models\SiteSetting;
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
        $login_id = SiteSetting::where('key', 'company_code')->first()->value . '-' . $next_id;
        return $login_id;
    }
}

if (!function_exists('getFormattedDate')) {
    function getFormattedDate($date)
    {
        return date('Y-m-d', strtotime($date));
    }
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

function saveModel($model, $request)
{
    $data = $request->only($model->getFillable());
    $model->fill($data);
    return $model;
}
