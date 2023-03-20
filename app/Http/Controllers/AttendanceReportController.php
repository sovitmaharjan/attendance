<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report\CommonReportRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceReportController extends Controller
{
    public function quickAttendanceReport(CommonReportRequest $request)
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        if ($request->employee) {
            $data['dropdown']['branch_id'] = $request->branch;
            $data['dropdown']['department_id'] = $request->department;
            $data['dropdown']['employee_id'] = $request->employee_id;
            $data['date']['from_date'] = $request->from_date;
            $data['date']['extra']['nepali_from_date'] = $request->nepali_from_date;
            $data['date']['to_date'] = $request->to_date;
            $data['date']['extra']['nepali_to_date'] = $request->nepali_to_date;
            $data['report'] = DB::select(
                DB::raw('
                    SELECT 
                        dates.date,
                        DATE_FORMAT(dates.date, "%W") as day,
                        IFNULL(sa.shift_name, "") as shift_name,
                        IFNULL(sa.shift_in_time, "") as shift_in_time,
                        IFNULL(sa.shift_out_time, "") as shift_out_time,
                        IFNULL(sa.holiday_name, "") as holiday_name,
                        IFNULL(sa.in_time, "") as in_time,
                        IFNULL(sa.in_diff, "") as in_diff,
                        IFNULL(sa.in_remark, "") as in_remark,
                        IFNULL(sa.out_time, "") as out_time,
                        IFNULL(sa.out_diff, "") as out_diff,
                        IFNULL(sa.out_remark, "") as out_remark,
                        IFNULL(sa.work_hour, "") as work_hour,
                        IFNULL(sa.off_day, "") as off_day,
                        sa.remarks
                    from (
                    SELECT "' . $request->from_date . '" + INTERVAL n DAY AS date
                        FROM (
                        SELECT @row := @row + 1 AS n
                            FROM (
                                SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                                UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
                                UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
                            ) a, (
                                SELECT 0 UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                                UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6
                                UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
                            ) b, (
                                SELECT @row := -1
                        ) r
                        WHERE @row < DATEDIFF("' . $request->to_date . '", "' . $request->from_date . '")
                    ) numbers WHERE "' . $request->from_date . '" + INTERVAL n DAY BETWEEN "' . $request->from_date . '" AND "' . $request->to_date . '"
                    ) dates 
                    left join (
                    select
                        s.name as shift_name,
                        DATE_FORMAT(s.in_time, "%H:%i") as shift_in_time,
                        DATE_FORMAT(s.out_time, "%H:%i") as shift_out_time,
                        DATE_FORMAT(sa.date, "%Y-%m-%d") as date,
                        DATE_FORMAT(sa.date, "%W") as day,
                        (case when hd.date is not null then h.name else "" end) as holiday_name,
                        IFNULL(DATE_FORMAT(sa.in_time, "%H:%i"), "") as in_time,
                        IFNULL(DATE_FORMAT(TIMEDIFF(sa.in_time, s.in_time), "%H:%i"), "") as in_diff,
                        (case when sa.in_time is not null then (case when sa.in_time > s.in_time then "late in" when sa.in_time = s.in_time then "on time"  else "early in" end) else "" end) as in_remark,
                        IFNULL(DATE_FORMAT(sa.out_time, "%H:%i"), "") as out_time,
                        IFNULL(DATE_FORMAT(TIMEDIFF(sa.out_time, s.out_time), "%H:%i"), "") as out_diff,
                        (case when sa.out_time is not null then (case when sa.out_time > s.out_time then "late out" when sa.out_time = s.out_time then "on time"  else "early out" end) else "" end) as out_remark,
                        IFNULL(DATE_FORMAT(TIMEDIFF(sa.out_time, sa.in_time), "%H:%i"), "") as work_hour,
                        attendance_status(sa.in_time, sa.out_time) as remarks,
                        case when JSON_SEARCH((select days from department_off_days_tracks where department_id = u.department_id), "one", DATE_FORMAT(sa.date, "%W")) is null then ""  else "1" end as off_day
                    from shift_assignments sa
                    join shifts s on s.id = sa.shift_id
                    left join holiday_dates hd on hd.date = sa.date
                    left join holidays h on h.id = hd.holiday_id
                    join users u on u.id = sa.employee_id
                    where sa.employee_id = ' . $request->employee . ' and sa.date between "' . $request->from_date . '" and "' . $request->to_date . '") sa
                    on sa.date = dates.date
                ')
            );
        }
        return view('quick-attendnce.index', $data);
    }

    public function monthlyAttendanceReport(Request $request)
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        if ($request->employee) {
            $data['dropdown']['branch_id'] = $request->branch;
            $data['dropdown']['department_id'] = $request->department;
            $data['dropdown']['employee_id'] = $request->employee_id;
            $data['date']['from_date'] = $request->from_date;
            $data['date']['extra']['nepali_from_date'] = $request->nepali_from_date;
            $data['date']['to_date'] = $request->to_date;
            $data['date']['extra']['nepali_to_date'] = $request->nepali_to_date;
            $data['report'] = DB::select('call countable_report(?,?,?)', array($request->employee, $request->from_date, $request->to_date))[0];
        }
        return view('monthly-attendance.index', $data);
    }
}
