<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = User::all();
        return view('employee.index', compact('employee'));
    }

    public function create()
    {
        $company = Company::all();
        $branch = Branch::all();
        $department = Department::all();
        $supervisor = User::where('department_id', null)->get();
        return view('employee.create', compact('company', 'branch', 'department', 'supervisor'));
    }

    public function store(EmployeeRequest $request)
    {
        try {
            $next_id = User::latest()->first() != false ? User::latest()->first()->id + 1 : 1;
            $login_id = Company::find($request->company_id)->code . '-' . $next_id;
            $data = $request->validated();
            $data['login_id'] = $login_id;
            $data['password'] = Str::random(7);
            User::create($data);
            return back()->with('success', 'Employee has been created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(User $employee)
    {
        $company = Company::all();
        $branch = Branch::all();
        $department = Department::all();
        $supervisor = User::where('department_id', null)->get();
        return view('employee.edit', compact('company', 'branch', 'department', 'supervisor', 'employee'));
    }

    public function update(EmployeeRequest $request, User $employee)
    {
        try {
            $next_id = User::latest()->first() != false ? User::latest()->first()->id + 1 : 1;
            $login_id = Company::find($request->company_id)->code . '-' . $next_id;
            $data = $request->validated();
            $data['login_id'] = $login_id;
            $data['password'] = Str::random(7);
            $employee->update($data);
            return redirect()->route('employee.index')->with('success', 'Employee has been created');
        } catch (Exception $e) {
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
