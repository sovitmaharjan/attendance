<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report\CommonReportRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Leave;
use App\Models\LeaveApplication;
use App\Models\LeaveAssignment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class LeaveBalanceController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data['branch'] = Branch::orderBy('name', 'asc')->get();
            $data['department'] = Department::orderBy('name', 'asc')->get();
            $data['employee'] = User::orderBy('firstname', 'asc')->get();
            $data['leave'] = Leave::all();
            if ($request->employee) {
                $data['dropdown']['branch_id'] = $request->branch;
                $data['dropdown']['department_id'] = $request->department;
                $data['dropdown']['employee_id'] = $request->employee_id;
                $data['leave_id'] = $request->leave;

                $leave_assignment = LeaveAssignment::where([
                    'leave_id' => $request->leave,
                    'employee_id' => $request->employee_id
                ])->first();
                if(!$leave_assignment) {
                    throw new Exception('Leave not found');
                }
                $data['result']['total_leave_assigned'] = $leave_assignment->allotted_days + $leave_assignment->carryover_days;
                $data['result']['available'] = $leave_assignment->total_remaining_days;
                $data['result']['used'] = $data['result']['total_leave_assigned'] - $data['result']['available'];
                $data['result']['applied'] = LeaveApplication::where([
                    'leave_id' => $request->leave,
                    'employee_id' => $request->employee_id,
                ])->count();
                $data['result'][LeaveApplication::PENDING] = LeaveApplication::where([
                    'leave_id' => $request->leave,
                    'employee_id' => $request->employee_id,
                    'status' => LeaveApplication::PENDING,
                ])->count();
                $data['result'][LeaveApplication::APPROVED] = LeaveApplication::where([
                    'leave_id' => $request->leave,
                    'employee_id' => $request->employee_id,
                    'status' => LeaveApplication::APPROVED,
                ])->count();
                $data['result'][LeaveApplication::CANCELLED] = LeaveApplication::where([
                    'leave_id' => $request->leave,
                    'employee_id' => $request->employee_id,
                    'status' => LeaveApplication::CANCELLED,
                ])->count();
            }
            return view('leave-balance.index', $data);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
