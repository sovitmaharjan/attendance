<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForceAttendance\ForceAttendanceRequest;
use App\Http\Resources\EmployeeWorkHourResource;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Department;
use App\Models\WorkHourAssignment;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class ForceAttendanceController extends Controller
{
    public function index()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        return view('force-attendance.index', $data);
    }

    public function store(ForceAttendanceRequest $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->force_attendance as $attendance) {
                $work_hour_assignment = WorkHourAssignment::where([
                    'employee_id' => $request->employee,
                    'assigned_date' => $attendance['date'],
                    'work_hour_id' => $attendance['work_hour']
                ])->first();
                foreach ($attendance['shift'] as $shift) {
                    $in = (Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($shift['in_date'])->format('Y-m-d') . Carbon::parse($shift['in_time'])->format('H:i:s')));
                    $out = (Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($shift['out_date'])->format('Y-m-d') . Carbon::parse($shift['out_time'])->format('H:i:s')));
                    $time_difference = Carbon::parse($out)->diff(Carbon::parse($in));
                    $attendance = Attendance::updateOrCreate(
                        [
                            'work_hour_assignment_id' => $work_hour_assignment->id,
                            'shift' => $shift['shift']
                        ],
                        [
                            'in_day' => $shift['in_date'] ? Carbon::parse($shift['in_date'])->format('l') : null,
                            'in_date' => $shift['in_date'] ? Carbon::parse($shift['in_date']) : null,
                            'in_time' => $shift['in_time'] ? Carbon::parse($shift['in_time']) : null,
                            'in_mode' => 'force',
                            'out_day' => $shift['out_date'] ? Carbon::parse($shift['out_date'])->format('l') : null,
                            'out_date' => $shift['out_date'] ? Carbon::parse($shift['out_date']) : null,
                            'out_time' => $shift['out_time'] ? Carbon::parse($shift['out_time']) : null,
                            'out_mode' => 'force',
                            'in_date_time' => Carbon::parse($in),
                            'out_date_time' => Carbon::parse($out),
                            'time_difference' => $time_difference->format('%H:%I:%S')
                        ]
                    );
                    // dd($attendance->toArray());
                }
            }
            DB::commit();
            return back()->with('success', 'Attendance has been updated');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function getEmployeeWorkHour()
    {
        $work_hour = WorkHourAssignment::where('employee_id', request()->employee_id)->whereBetween('assigned_date', [request()->from_date, request()->to_date])->get();
        return response()->json(EmployeeWorkHourResource::collection($work_hour));
    }
}
