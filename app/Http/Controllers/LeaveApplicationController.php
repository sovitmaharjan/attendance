<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveApplicationRequest;
use App\Models\Leave;
use App\Models\LeaveApplication;
use Carbon\Carbon;

class LeaveApplicationController extends Controller
{
    public function index()
    {
        //
    }

    public function store(LeaveApplicationRequest $request)
    {
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);
        $leave_days_count = $start_date->diffInDays($end_date) + 1;
        $allowed_days = Leave::find($request->leave_id)->allowed_days;
        $remaining_allowed_days = $allowed_days - $leave_days_count;
        $leave_application = LeaveApplication::create([
            'leave_id' => $request->leave_id,
            'employee_id' => $request->employee_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'leave_days_count' => $leave_days_count,
            'remaining_allowed_days' => $remaining_allowed_days,
            'description' => $request->description,
            'approver' => $request->approver,
        ]);
        dd($leave_application);
    }
}
