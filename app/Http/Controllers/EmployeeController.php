<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $data['employees'] = User::all();
        return view('employee.index', $data);
    }

    public function create()
    {
        $data['company'] = Company::all();
        $data['branch'] = Branch::all();
        $data['department'] = Department::all();
        $data['supervisors'] = User::all();
        $data['designation'] = Designation::all();
        $data['role'] = Role::all();
        return view('employee.create', $data);
    }

    public function store(EmployeeRequest $request)
    {
        try {
            DB::beginTransaction();
//            $next_id = User::latest()->first() != false ? User::latest()->first()->id + 1 : 1;
//            $login_id = Company::find($request->company_id)->code . '-' . $next_id;
            $extra = [
                'nepali_dob' => $request->nepali_dob,
                'nepali_join_date' => $request->nepali_join_date,
            ];
            $request->only((new User())->getFillable());
            $request->request->add([
                'extra' => $extra,
//                'login_id' => $login_id,
                'password' => Str::random(7)
            ]);
            User::create($request->all());
            DB::commit();
            return back()->with('success', 'Employee has been created');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(User $employee)
    {
        $data['company'] = Company::all();
        $data['branch'] = Branch::all();
        $data['department'] = Department::all();
        $data['supervisors'] = User::all();
        $data['designation'] = Designation::all();
        $data['role'] = Role::all();
        $data['employee'] = $employee;
        return view('employee.edit', $data);
    }

    public function update(EmployeeRequest $request, User $employee)
    {
        try {
            DB::beginTransaction();
            $extra = [
                'nepali_dob' => $request->nepali_dob,
                'nepali_join_date' => $request->nepali_join_date,
            ];
            $request->only((new User())->getFillable());
            $request->request->add([
                'extra' => $extra,
            ]);
            $employee->update($request->all());
            DB::commit();
            return redirect()->route('employee.index')->with('success', 'Employee has been updated');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(User $employee)
    {
        try {
            $employee->delete();
            return redirect()->route("employee.index")->with("success", "Employee has been deleted");
        } catch (Exception $e) {
            return redirect()->route("employee.index")->with("error", $e->getMessage());
        }
    }
}
