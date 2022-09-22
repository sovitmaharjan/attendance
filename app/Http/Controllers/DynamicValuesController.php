<?php

namespace App\Http\Controllers;

use App\Methods\AdminMethods;
use App\Models\DynamicValue;
use Illuminate\Http\Request;

class DynamicValuesController extends Controller
{
    use AdminMethods;

    private $page = 'dynamic_values.';

    public function getValues(Request $request)
    {
        $dynamic_values = DynamicValue::where('key', $request)->get();
        return $this->view($this->page ."index", [
            'dynamic_values' => $dynamic_values
        ]);
    }

    public function save(Request $request)
    {

    }
}
