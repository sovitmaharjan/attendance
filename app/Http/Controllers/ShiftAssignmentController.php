<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftAssignmentRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Shift;
use App\Models\ShiftAssignment;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Http\Request;
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
        // dd($request->all());
        try {
            DB::beginTransaction();
            foreach ($request->shift_repeater as $item) {
                $dates = CarbonPeriod::create($item['from_date'], $item['to_date']);
                foreach ($dates as $date) {
                    ShiftAssignment::firstOrCreate(
                        [
                            'shift_id' => $item['shift'],
                            'employee_id' => $request->employee,
                            'date' => $date
                        ],
                        [
                            'extra' => [
                                'nep_from_date' => $item['nep_from_date'],
                                'nep_to_date' => $item['nep_to_date']
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
