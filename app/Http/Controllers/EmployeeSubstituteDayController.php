<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeSubstituteDayRequest;
use App\Models\EmployeeSubstituteDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeSubstituteDayController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }

    public function store(EmployeeSubstituteDayRequest $request)
    {
        try{
            DB::beginTransaction();
            $extras = [
              'work_nepali_date' => $request->work_nepali_date,
              'substituted_to_nepali_date' => $request->substituted_to_nepali_date,
            ];
            $request->request->add([
               'extra' => $extras,
            ]);
            EmployeeSubstituteDay::create($request->all());
            DB::commit();
            return response()->json(['success' => true, 'message' => "Day substituted"]);
        } catch (\Exception $e){
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
