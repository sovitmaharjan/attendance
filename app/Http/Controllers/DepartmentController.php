<?php

namespace App\Http\Controllers;

use App\Models\DynamicValue;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Http\Requests\DepartmentRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{

    function __construct()
    {
        $this->helper = new Helper;
    }

    public function index()
    {
        $page = "Department";
        $data['records'] = Department::all();
        return view('department.index', $data, compact('page'));
    }

    public function create()
    {
        $page = "Department";
        $company = Company::all();
        $branch = Branch::all();
        return view('department.create', compact('page', 'company', 'branch'));
    }

    public function store(DepartmentRequest $request, Department $department)
    {
        try {
            $data = $this->helper->getObject($department, $request);
            $data['company_id'] = $request->company_id;
            $data['branch_id'] = $request->branch_id;
            $data->save();
            return back()->with('success', 'New Department has been added');
        } catch (\Exception$e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $page = "Department";
        $company = Company::all();
        $branch = Branch::all();
        $data = Department::findOrFail($id);
        return view('department.edit', compact('page', 'data', 'company', 'branch'));
    }

    public function update(Request $request, $id)
    {
        $company = Department::findOrFail($id);
        $data = $this->helper->getObject($company, $request);
        $data['company_id'] = $request->company_id;
        $data['branch_id'] = $request->branch_id;
        $data->update();
        return to_route('department.index')->with('success', 'Department has been updated');
    }

    public function destroy($id)
    {
        $company = Department::findOrFail($id)->delete();
        return to_route('department.index')->with('success', 'Department has been deleted');
    }

    public function assingOffDays(Request $request)
    {
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'key' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->getMessages()]);
        }
        try {
            DB::beginTransaction();
            $value = [
                'off_days' => $request->days,
            ];
            DynamicValue::updateOrCreate([
                'id' => $request->id,
                'key' => $request->key,
            ], [
                'key' => $request->key,
                'name' => $request->key,
                'value' => $value,
                'status' => 1
            ]);
            DB::commit();
            return response()->json(['message' => 'Successfully assigned']);
        } catch (\Exception$e) {
            DB::rollBack();
            return $this->sendDbError($e->getMessage());
        }
    }

    public function departmentOffDays(Request $request, $id)
    {
        $off_days = DynamicValue::where('key', 'department_' . $id)->first();
//        return view('department.off_days', compact('off_days'));
        if ($off_days) {
            return response()->json([
                'dynamic_id' => $off_days->id,
                'off_days' => $off_days->value['off_days'],
                'status' => true,
                'message' => 'Off Days fetched !!!'
            ]);
        }
        return response()->json([
            'message' => 'No data found !!!',
            'status' => false,
        ]);
    }
}
