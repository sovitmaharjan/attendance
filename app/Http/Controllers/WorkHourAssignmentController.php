<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkHour\WorkHourAssignmentRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\User;
use App\Models\WorkHour;
use App\Models\WorkHourAssignment;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WorkHourAssignmentController extends Controller
{
    public function create()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        $data['work_hour'] = WorkHour::orderBy('name', 'asc')->get();
        return view('work-hour-assignment.create', $data);
    }

    public function store(WorkHourAssignmentRequest $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->work_hour_repeater as $item) {
                $dates = CarbonPeriod::create($item['from_date'], $item['to_date']);
                foreach ($dates as $date) {
                    $day = Carbon::parse($date)->format('l');
                    WorkHourAssignment::updateOrCreate(
                        [
                            'employee_id' => $request->employee,
                            'assigned_date' => $date
                        ],
                        [
                            'work_hour_id' => $item['work_hour'],
                            'assigned_day' => $day,
                            'off_day' => in_array($day, $request->off_day),
                            'extra' => [
                                'nepali_from_date' => $item['nepali_from_date'],
                                'nepali_to_date' => $item['nepali_to_date']
                            ]
                        ]
                    );
                }
            }
            DB::commit();
            return back()->with('success', 'Work Hour has been assigned');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
