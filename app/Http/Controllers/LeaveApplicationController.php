<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveApplicationRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Leave;
use App\Models\LeaveApplication;
use App\Models\User;
use Carbon\Carbon;

class LeaveApplicationController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        return view('leave-application.create', $data);
    }

    public function store(LeaveApplicationRequest $request)
    {
        $from_date = Carbon::parse($request->from_date);
        $to_date = Carbon::parse($request->to_date);
        $leave_days_count = $from_date->diffInDays($to_date) + 1;
        $allowed_days = Leave::find($request->leave_id)->allowed_days;
        $remaining_allowed_days = $allowed_days - $leave_days_count;
        $leave_application = LeaveApplication::create([
            'leave_id' => $request->leave_id,
            'employee_id' => $request->employee_id,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'leave_days_count' => $leave_days_count,
            'remaining_allowed_days' => $remaining_allowed_days,
            'description' => $request->description,
            'approver' => $request->approver,
        ]);
        dd($leave_application);
    }
}
