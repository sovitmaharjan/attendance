<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Leave;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Support\Carbon;
use App\Models\LeaveApplication;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Leave\LeaveApplicationRequest;
use App\Models\LeaveAssignment;

class LeaveApplicationController extends Controller
{
    public function index()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        $data['leave'] = Leave::all();
        return view('leave-application.index', $data);
    }

    public function store(LeaveApplicationRequest $request)
    {
        try {
            DB::beginTransaction();
            $difference = Carbon::parse($request->to_date)->diffInDays(Carbon::parse($request->from_date)) + 1;
            $data = $request->validated();
            dd($data, 'controller');
            $data['leave_days_count'] = $difference;
            LeaveApplication::create($data);
            DB::commit();
            return back()->with('success', 'Your leave application has been created and pending for approval');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('error', $e->getMessage());
        }
    }

    public function getLeaveApplicationData()
    {
        $leave_assignment = LeaveAssignment::where([
            'leave_id' => request()->leave_id,
            'employee_id' => request()->employee_id
        ])->firstOrFail();
        $data['total_leave_assigned'] = $leave_assignment->allotted_days + $leave_assignment->carryover_days;
        $data['available'] = $leave_assignment->total_remaining_days;
        $data['used'] = $data['total_leave_assigned'] - $data['available'];
        $data['applied'] = LeaveApplication::where([
            'leave_id' => request()->leave_id,
            'employee_id' => request()->employee_id,
        ])->count();
        $data['pending'] = LeaveApplication::where([
            'leave_id' => request()->leave_id,
            'employee_id' => request()->employee_id,
            'status' => 'pending',
        ])->count();
        $data['approved'] = LeaveApplication::where([
            'leave_id' => request()->leave_id,
            'employee_id' => request()->employee_id,
            'status' => 'approved',
        ])->count();
        $data['cancelled'] = LeaveApplication::where([
            'leave_id' => request()->leave_id,
            'employee_id' => request()->employee_id,
            'status' => 'cancelled',
        ])->count();
        return response()->json([
            'success' => true,
            'message' => 'Leave Data',
            'data' => $data
        ], 200);
    }
}
