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

    public function getLeaveData()
    {
        $data = [];
        dump(request()->all());
        if (request()->employee_id && request()->leave_id) {
            $data['applied'] = LeaveAssignment::where([
                'employee_id' => request()->employee_id,
                'leave_id' => request()->leave_id,
                'year' => date('Y')
            ])->get()->count();
            $data['approved'] = LeaveApplication::where([
                'employee_id' => request()->employee_id,
                'leave_id' => request()->leave_id,
                'year' => date('Y'),
                'is_approved' => 1
            ])->get()->count();
        }
        dd($data);
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        $data['leave'] = Leave::all();
        return view('leave-application.create', $data);
    }

    public function store(LeaveApplicationRequest $request)
    {
        dd($request->all());
        try {
            DB::beginTransaction();
            $difference = Carbon::parse($request->to_date)->diffInDays(Carbon::parse($request->from_date));
            $data = $request->validated();
            $data['leave_days_count'] = $difference + 1;
            $leave_application = LeaveApplication::create($data);
            for ($i = 0; $i <= $difference; $i++) {
                $leave_application->leave_application_dates()->create([
                    'date' => Carbon::parse($request->from_date)->addDays($i)
                ]);
            }
            DB::commit();
            return back()->with('success', 'Your leave application has been created and pending for approval');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('error', $e->getMessage());
        }
    }
}
