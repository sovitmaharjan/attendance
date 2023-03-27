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
use App\Http\Requests\Leave\LeaveAssignmentRequest;
use Illuminate\Http\Request;

class LeaveAssignmentController extends Controller
{
    public function index()
    {
        $a = LeaveAssignment::where([
            'employee_id' => 1,
            'leave_id' => 1,
        ])
        ->where('year', '<', date('Y'))
        // ->wherehas('remainingDay', function($q) {
        //     $q->where('year', '<', date('Y'));
        // })
        ->get()->toArray();
        dd($a);
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        $data['leave'] = Leave::orderBy('name', 'asc')->get();
        return view('leave-assignment.index', $data);
    }

    public function store(Request $request)
    {
        $a = LeaveAssignment::where([
            'employee_id' => request()->employee_id,
            'leave_id' => request()->leave_id,
        ])->where('year', '<', date('Y'))->get();
        dd($a);
        dd($request->all());
        try {
            DB::beginTransaction();
            foreach ($request->leave_repeater as $item) {
                $leave_assignment = LeaveAssignment::firstOrCreate(
                    [
                        'leave_id' => $item['leave'],
                        'employee_id' => $request->employee,
                    ],
                    [
                        'allotted_days' => $item['allotted_days']
                    ]
                );
                $leave_assignment->remaining_days()->updateOrCreate(
                    [
                        'leave_assignment_id' => $leave_assignment->id
                    ],
                    [
                        'current_year_remaining_days' => $item['allotted_days'],
                        'final_remaining_days' => $item['allotted_days']
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



    public function getPreviousYearRemainingDays()
    {
        dump(request()->all());
        $data = LeaveAssignment::where([
            'employee_id' => request()->employee_id,
            'leave_id' => request()->leave_id,
        ])->where('year', '<', date('Y'))->get();
        dd($data);
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        $data['leave'] = Leave::all();
        return view('leave-application.create', $data);
    }
}
