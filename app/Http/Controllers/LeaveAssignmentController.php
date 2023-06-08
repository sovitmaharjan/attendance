<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Leave;
use App\Models\Branch;
use App\Models\Department;
use App\Models\LeaveAssignment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveAssignmentController extends Controller
{
    public function index()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        $data['leave'] = Leave::orderBy('name', 'asc')->get();
        return view('leave-assignment.index', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->leave_repeater as $item) {
                $carryover_days = isset($item['carryover_days']) && $item['carryover_days'][0] == "on"
                    ? LeaveAssignment::where([
                        'employee_id' => request()->employee_id,
                        'leave_id' => $item['leave'],
                    ])->where('year', date('Y') - 1)->first()->total_remaining_days ?? 0
                    : 0;
                LeaveAssignment::updateOrCreate(
                    [
                        'leave_id' => $item['leave'],
                        'employee_id' => $request->employee,
                        'year' => date('Y')
                    ],
                    [
                        'allotted_days' => $item['allotted_days'],
                        'carryover_days' => $carryover_days,
                        'total_remaining_days' => $item['allotted_days'] + $carryover_days
                    ]
                );
            }
            DB::commit();
            return back()->with('success', 'Leave has been assigned');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function getLeaveData()
    {
        $data['leave'] = Leave::find(request()->leave_id);
        $data['previous_remaining_days'] = LeaveAssignment::where([
            'employee_id' => request()->employee_id,
            'leave_id' => request()->leave_id,
        ])->where('year', date('Y') - 1)->first()->total_remaining_days ?? 0;
        return responseSuccess($data, 'Leave data', 200);
    }
}
