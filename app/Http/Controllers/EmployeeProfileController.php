<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\EmployeeProfileRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Role;
use App\Models\SiteSetting;
use App\Models\User;

class EmployeeProfileController extends Controller
{
    public function index()
    {
        $companyName = SiteSetting::where('key', 'company_code')->first();
        if (!$companyName) {
            return redirect()->route('company.index')->with('info', 'Set Company\'s Name before creating employee');
        }
        $data['branch'] = Branch::all();
        $data['department'] = Department::all();
        $data['supervisors'] = User::all();
        $data['designation'] = Designation::all();
        $data['role'] = Role::all();
        return view('employee-profile.index', $data);
    }

    public function store(EmployeeProfileRequest $request)
    {
        //
    }
}
