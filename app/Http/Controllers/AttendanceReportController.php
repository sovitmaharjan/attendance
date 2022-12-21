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
            $data['report'] = DB::table('shift_assignments as sa')
                ->join('shifts as s', 's.id', '=', 'sa.shift_id')
                ->select(
                    'sa.id',
                    'sa.shift_id',
                    'sa.employee_id',
                    DB::raw('IFNULL(DATE_FORMAT(sa.in_time, "%H:%i"), "") as in_time'),
                    DB::raw('IFNULL(DATE_FORMAT(sa.out_time, "%H:%i"), "") as out_time'),
                    DB::raw('DATE_FORMAT(sa.date, "%Y-%m-%d") as date'),
                    DB::raw('DATE_FORMAT(sa.date, "%W") as day'),
                    'sa.extra',
                    DB::raw('DATE_FORMAT(sa.created_at, "%Y-%m-%d") as created_at'),
                    DB::raw('DATE_FORMAT(sa.updated_at, "%Y-%m-%d") as updated_at'),
                    's.name as shift_name',
                    DB::raw('DATE_FORMAT(s.in_time, "%H:%i") as shift_in_time'),
                    DB::raw('DATE_FORMAT(s.out_time, "%H:%i") as shift_out_time'),
                    DB::raw('DATE_FORMAT(s.in_time_last, "%H:%i") as in_time_last'),
                    DB::raw('DATE_FORMAT(s.out_time_last, "%H:%i") as out_time_last'),
                    's.break_time',
                    DB::raw('DATE_FORMAT(s.created_at, "%Y-%m-%d") as shift_created_at'),
                    DB::raw('DATE_FORMAT(s.updated_at, "%Y-%m-%d") as shift_updated_at'),
                    DB::raw('IFNULL(s.extra, "") as shift_extra'),
                    DB::raw('(case when sa.in_time is not null then (case when sa.in_time > s.in_time then "late in" when sa.in_time = s.in_time then "on time"  else "early in" end) else "" end) as in_remark'),
                    DB::raw('(case when sa.out_time is not null then (case when sa.out_time > s.out_time then "late out" when sa.out_time = s.out_time then "on time"  else "early out" end) else "" end) as out_remark'),
                    DB::raw('IFNULL(DATE_FORMAT(TIMEDIFF(sa.in_time, s.in_time), "%H:%i"), "") as in_diff'),
                    DB::raw('IFNULL(DATE_FORMAT(TIMEDIFF(sa.out_time, s.out_time), "%H:%i"), "") as out_diff'),
                    DB::raw('IFNULL(DATE_FORMAT(TIMEDIFF(sa.out_time, sa.in_time), "%H:%i"), "") as work_hour')
                )
                ->where([
                    'employee_id' => $request->employee
                ])
                ->whereBetween('date', [$request->from_date, $request->to_date])
                ->orderBy('date')
                ->get();
                // dd($data['report'], $request->all());
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
            $data['report'] = DB::table('shift_assignments as sa')
                ->join('shifts as s', 's.id', '=', 'sa.shift_id')
                ->select(
                    DB::raw('count(*) as total_day'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as weekend_day'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as absent_day'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as public_holiday'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as working_day'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as absent_day'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as kriya'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as maternity'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as paternity'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as isolation'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as travel'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as present_day'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as work_in_weekend'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as work_on_public_holiday'),
                    DB::raw('count(case when DAYOFWEEK(sa.date) in (1, 7) then 1 end) as worked_hour')
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
