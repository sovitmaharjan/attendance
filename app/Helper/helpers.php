<?php

use App\Models\DynamicValue;

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
