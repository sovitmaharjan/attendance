<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForceAttendanceRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\ShiftAssignment;
use App\Models\User;
use Illuminate\Http\Request;

class ForceAttendanceController extends Controller
{
    public function index()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        return view('force-attendance.index', $data);
    }

    public function store(ForceAttendanceRequest $request)
    {
        dd($request->all());
        $data = [];
        ShiftAssignment::where([
            'employee_id' => $request->employee_id,
            'date'
        ])->update($data);
    }

    public function getEmployeeShift() {
        
    }
}
