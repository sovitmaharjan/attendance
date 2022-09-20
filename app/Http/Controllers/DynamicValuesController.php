<?php

namespace App\Http\Controllers;

use App\Methods\AdminMethods;
use App\Models\DynamicValue;
use Illuminate\Http\Request;

class DynamicValuesController extends Controller
{
    use AdminMethods;

    private $page = 'dynamic_values.';

    public function getPrefix(Request $request)
    {
        $prefix = DynamicValue::where('key', 'prefix')->first();
        return $this->view($this->page ."prefix", [
            'prefix' => $prefix
        ]);
    }
}
