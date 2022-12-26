<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\ShiftAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['branch'] = Branch::count();
        $data['department'] = Department::count();
        $data['employee'] = User::count();
        $data['total_employee'] = DB::table('users')->count();
        $data['present'] = ShiftAssignment::where(function ($q) {
            $q->whereNotNull('in_time')->orWhereNotNull('out_time');
        })->where('date', Carbon::today())->select('employee_id', 'date')->with('employee')->get();
        $data['absent'] = ShiftAssignment::whereNull('in_time')->whereNull('out_time')->where('date', Carbon::today())->select('employee_id', 'date')->with('employee')->get();
        $data['leave'] = Leave::orderBy('name', 'asc')->get();
        $data['event'] = DB::select('
            select 
                DATE_FORMAT(dob, "%M %d (%W)") as date,
                "birthday" as type, 
                concat(
                    firstname,
                    case
                        when middlename is null then "" else " "
                    end,
                    middlename,
                    " ",
                    lastname
                ) as name
            from users
            where DATE_FORMAT(dob, "%m-%d") > DATE_FORMAT(CURDATE(), "%m-%d")
            union all
            select
                DATE_FORMAT(date, "%M %d (%W)"),
                "holiday" as type,
                (select name from holidays where id = holiday_id) as name
            from holiday_dates
            where date > CURDATE()
            order by date asc;
        ');
        return view('dashboard', $data);
    }
}
