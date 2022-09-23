<?php
use App\Models\DynamicValue;

if (!function_exists('getDynamicValues')){
    function getDynamicValues($key){
        return DynamicValue::where('key', $key)->get();
    }
}
