<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceReportController extends Controller
{
    public function quickAttendanceReport(Request $request)
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        if ($request->employee) {
            $data['report'] = DB::table('shift_assignments')
                ->join('shifts', 'shifts.id', '=', 'shift_assignments.shift_id')
                ->select(
                    'shift_assignments.id',
                    'shift_assignments.shift_id',
                    'shift_assignments.employee_id',
                    DB::raw('IFNULL(DATE_FORMAT(shift_assignments.in_time, "%H:%i"), "") as in_time'),
                    DB::raw('IFNULL(DATE_FORMAT(shift_assignments.out_time, "%H:%i"), "") as out_time'),
                    DB::raw('DATE_FORMAT(shift_assignments.date, "%Y-%m-%d") as date'),
                    DB::raw('DATE_FORMAT(shift_assignments.date, "%W") as day'),
                    'shift_assignments.extra',
                    DB::raw('DATE_FORMAT(shift_assignments.created_at, "%Y-%m-%d") as created_at'),
                    DB::raw('DATE_FORMAT(shift_assignments.updated_at, "%Y-%m-%d") as updated_at'),
                    'shifts.name as shift_name',
                    DB::raw('DATE_FORMAT(shifts.in_time, "%H:%i") as shift_in_time'),
                    DB::raw('DATE_FORMAT(shifts.out_time, "%H:%i") as shift_out_time'),
                    DB::raw('DATE_FORMAT(shifts.in_time_last, "%H:%i") as in_time_last'),
                    DB::raw('DATE_FORMAT(shifts.out_time_last, "%H:%i") as out_time_last'),
                    'shifts.break_time',
                    DB::raw('DATE_FORMAT(shifts.created_at, "%Y-%m-%d") as shift_created_at'),
                    DB::raw('DATE_FORMAT(shifts.updated_at, "%Y-%m-%d") as shift_updated_at'),
                    DB::raw('IFNULL(shifts.extra, "") as shift_extra'),
                    DB::raw('(case when shift_assignments.in_time is not null then (case when shift_assignments.in_time > shifts.in_time then "late in" when shift_assignments.in_time = shifts.in_time then "on time"  else "early in" end) else "" end) as in_remark'),
                    DB::raw('(case when shift_assignments.out_time is not null then (case when shift_assignments.out_time > shifts.out_time then "late out" when shift_assignments.out_time = shifts.out_time then "on time"  else "early out" end) else "" end) as out_remark'),
                    DB::raw('IFNULL(DATE_FORMAT(TIMEDIFF(shift_assignments.in_time, shifts.in_time), "%H:%i"), "") as in_diff'),
                    DB::raw('IFNULL(DATE_FORMAT(TIMEDIFF(shift_assignments.out_time, shifts.out_time), "%H:%i"), "") as out_diff'),
                    DB::raw('IFNULL(DATE_FORMAT(TIMEDIFF(shift_assignments.out_time, shift_assignments.in_time), "%H:%i"), "") as work_hour')
                )
                ->where([
                    'employee_id' => $request->employee
                ])
                ->whereBetween('date', [$request->from_date, $request->to_date])
                ->orderBy('date')
                ->get();
        }
        return view('quick-attendnce.index', $data);
    }

    public function monthlyAttendanceReport(Request $request)
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        if ($request->employee) {
            DB::statement("SET SQL_MODE=''");
            $data['report'] = DB::table('shift_assignments')
                ->join('shifts', 'shifts.id', '=', 'shift_assignments.shift_id')
                ->select(
                    DB::raw('count(*) as total_day'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as weekend_day'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as absent_day'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as public_holiday'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as working_day'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as absent_day'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as kriya'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as maternity'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as paternity'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as isolation'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as travel'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as present_day'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as work_in_weekend'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as work_on_public_holiday'),
                    DB::raw('count(case when DAYOFWEEK(shift_assignments.date) in (1, 7) then 1 end) as worked_hour')
                )
                ->where([
                    'employee_id' => 1
                ])
                ->whereBetween('date', ['2022-11-01', '2022-11-20'])
                ->orderBy('date')
                ->first();
            // dd($data['report']);
        }
        DB::statement("SET SQL_MODE='ONLY_FULL_GROUP_BY'");
        return view('monthly-attendance.index', $data);
    }
}
