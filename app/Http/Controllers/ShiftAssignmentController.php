<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shift\ShiftAssignmentRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Shift;
use App\Models\ShiftAssignment;
use App\Models\User;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Support\Facades\DB;

class ShiftAssignmentController extends Controller
{
    public function index()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        $data['shift'] = Shift::orderBy('name', 'asc')->get();
        return view('shift-assignment.index', $data);
    }

    public function store(ShiftAssignmentRequest $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->shift_repeater as $item) {
                $dates = CarbonPeriod::create($item['from_date'], $item['to_date']);
                foreach ($dates as $date) {
                    ShiftAssignment::updateOrCreate(
                        [
                            // 'shift_id' => $item['shift'],
                            'employee_id' => $request->employee,
                            'date' => $date
                        ],
                        [
                            'shift_id' => $item['shift'],
                            'extra' => [
                                'nepali_from_date' => $item['nepali_from_date'],
                                'nepali_to_date' => $item['nepali_to_date']
                            ]
                        ]
                    );
                }
            }
            DB::commit();
            return back()->with('success', 'Shift has been assigned');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
