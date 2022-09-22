<?php

namespace App\Http\Controllers;

use App\Methods\AdminMethods;
use App\Models\DynamicValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DynamicValuesController extends Controller
{
    use AdminMethods;

    private $page = 'dynamic_values.';

    public function getValues(Request $request)
    {
        $dynamic_values = DynamicValue::where('key', $request->setup)->paginate(10);
        return $this->view($this->page . "index", [
            'dynamic_values' => $dynamic_values
        ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => ['required'],
            'name' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->getMessages()]);
        }
        try {
            DB::beginTransaction();
            $value = [
              'name' => $request->name,
              'status' => 1,
            ];
            DynamicValue::updateOrCreate([
                'id' => $request->id,
            ], [
                'key' => $request->key,
                'name' => $request->name,
                'value' => $value,
            ]);
            DB::commit();
            return response()->json(['message' => 'Successfully created']);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendDbError($e->getMessage());
        }
    }

    public function edit($id)
    {
        $dynamic_value = DynamicValue::find($id);
        return response()->json(['dynamic_value' => $dynamic_value]);
    }
}
