<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForceAttendanceRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\ShiftAssignment;
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
            foreach($request->force_attendance as $item) {
                ShiftAssignment::where([
                    'employee_id' => $request->employee_id,
                    'date' => $item['date'],
                    'shift_id' => $item['shift']
                ])->update([
                    'in_time' => $item['in_time'] ? Carbon::parse($item['in_time']) : NULL,
                    'out_time' => $item['out_time'] ? Carbon::parse($item['out_time']): NULL
                ]);
            }
            DB::commit();
            return redirect()->route('force-attendance.index')->with('success', 'Force attendance has been updated');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function getEmployeeShift() {
        $shift = ShiftAssignment::where('employee_id', request()->employee_id)->whereBetween('date', [request()->start_date, request()->end_date])->get()->map(function($m) {
            return [
                'id' => $m->id,
                'shift' => $m->shift,
                'employee_id' => $m->employee_id,
                'in_time' => $m->in_time ? $m->in_time->format('H:i') : '',
                'out_time' => $m->out_time ? $m->out_time->format('H:i') : '',
                'date' => $m->date->format('Y-m-d'),
                'extra' => $m->extra,
                'created_at' => $m->created_at->format('Y-m-d'),
                'updated_at' => $m->updated_at->format('Y-m-d'),
            ];
        });
        return response()->json($shift);
    }
}
