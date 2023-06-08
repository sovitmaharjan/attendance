<?php

namespace App\Http\Controllers;

use App\Http\Requests\HolidayAssignment\HolidayAssignmentRequest;
use App\Http\Requests\HolidayAssignment\StoreHolidayAssignmentRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Holiday;
use App\Models\HolidayAssignment;
use App\Models\User;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HolidayAssignmentController extends Controller
{
    public function index(HolidayAssignmentRequest $request)
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['holiday'] = Holiday::orderBy('from_date', 'asc')->get();
        if ($request->holiday) {
            $data['dropdown']['branch_id'] = $request->branch;
            $data['dropdown']['department_id'] = $request->department;
            $data['dropdown']['holiday_id'] = $request->holiday;
            $department = $request->department;
            $data['employee'] = User::where('branch_id', $request->branch)->when($request->department, function ($q) use ($department) {
                $q->where('department_id', $department);
            })->get();
        }
        return view('holiday-assignment.index', $data);
    }

    public function store(StoreHolidayAssignmentRequest $request)
    {
        try {
            DB::beginTransaction();
            $holiday = Holiday::find($request->holiday);
            $dates = CarbonPeriod::create($holiday->from_date, $holiday->to_date);
            foreach ($request->employee as $item) {
                foreach ($dates as $date) {
                    HolidayAssignment::updateOrCreate(
                        [
                            'holiday_id' => $request->holiday,
                            'employee_id' => $item,
                            'assigned_date' => Carbon::parse($date),
                        ],
                        [
                            'assigned_day' => Carbon::parse($date)->format('l')
                        ]
                    );
                }
            }
            DB::commit();
            return back()->with('success', 'Holiday has been assigned');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
