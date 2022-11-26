<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Shift;
use App\Models\ShiftAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceReportController extends Controller
{
    public function quickAttendanceReport()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        return view('quick-attendnce.index', $data);
        dd(
            DB::table('shift_assignments')
            ->join('shifts', 'shifts.id', '=', 'shift_assignments.shift_id')
            ->select(
                'shift_assignments.id',
                'shift_assignments.shift_id',
                'shift_assignments.employee_id',
                DB::raw('IFNULL(shift_assignments.in_time, "") as in_time'),
                DB::raw('IFNULL(shift_assignments.out_time, "") as out_time'),
                'shift_assignments.date',
                'shift_assignments.extra',
                'shift_assignments.created_at',
                'shift_assignments.updated_at',
                'shifts.in_time as shift_in_time',
                'shifts.out_time as shift_out_time',
                'shifts.in_time_last',
                'shifts.out_time_last',
                'shifts.break_time',
                'shifts.created_at as shift_created_at',
                'shifts.updated_at as shift_updated_at',
                DB::raw('IFNULL(shifts.extra, "") as shift_extra'),
                DB::raw('(case when shift_assignments.in_time is not null then (case when shift_assignments.in_time > shifts.in_time then "late in" when shift_assignments.in_time = shifts.in_time then "on time"  else "early in" end) else "" end) as in_remark'),
                DB::raw('(case when shift_assignments.out_time is not null then (case when shift_assignments.out_time > shifts.out_time then "late out" when shift_assignments.out_time = shifts.out_time then "on time"  else "early out" end) else "" end) as out_remark'),
                DB::raw('IFNULL(TIMEDIFF(shift_assignments.in_time, shifts.in_time), "") as in_diff'),
                DB::raw('IFNULL(TIMEDIFF(shift_assignments.out_time, shifts.out_time), "") as out_diff'),
                DB::raw('IFNULL(TIMEDIFF(shift_assignments.out_time, shift_assignments.in_time), "") as work_hour')
            )
            ->where([
                'employee_id' => 1
            ])
            ->whereBetween('date', ['2022-11-01', '2022-11-20'])
            ->orderBy('date')
            ->get()
        );
    }
    public function monthlyAttendanceReport()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        return view('monthly-attendance.index', $data);
    }
}
