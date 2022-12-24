<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveApplicationRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Leave;
use App\Models\LeaveApplication;
use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        $data['leave'] = Leave::all();
        return view('leave-application.create', $data);
    }

    public function store(LeaveApplicationRequest $request)
    {
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
