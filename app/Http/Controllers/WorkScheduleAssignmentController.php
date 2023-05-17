<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkSchedule\WorkScheduleAssignmentRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\User;
use App\Models\WorkSchedule;
use App\Models\WorkScheduleAssignment;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WorkScheduleAssignmentController extends Controller
{
    public function create()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        $data['work_schedule'] = WorkSchedule::orderBy('name', 'asc')->get();
        return view('work-schedule-assignment.create', $data);
    }

    public function store(WorkScheduleAssignmentRequest $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->work_schedule_repeater as $item) {
                $dates = CarbonPeriod::create($item['from_date'], $item['to_date']);
                foreach ($dates as $date) {
                    WorkScheduleAssignment::updateOrCreate(
                        [
                            'employee_id' => $request->employee,
                            'date' => $date
                        ],
                        [
                            'work_schedule_id' => $item['work_schedule'],
                            'extra' => [
                                'nepali_from_date' => $item['nepali_from_date'],
                                'nepali_to_date' => $item['nepali_to_date']
                            ],
                            'off_day' => in_array(Carbon::parse($date)->format('l'), $request->off_day)
                        ]
                    );
                }
            }
            DB::commit();
            return back()->with('success', 'Work Schedule has been assigned');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
