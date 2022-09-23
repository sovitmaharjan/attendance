<?php

use App\Models\Company;
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
