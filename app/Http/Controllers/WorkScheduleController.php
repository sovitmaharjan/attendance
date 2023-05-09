<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkSchedule\StoreWorkScheduleRequest;
use App\Http\Requests\WorkSchedule\UpdateWorkScheduleRequest;
use App\Models\WorkSchedule;
use Exception;
use Illuminate\Support\Facades\DB;

class WorkScheduleController extends Controller
{
    public function index()
    {
        $data['work_schedule'] = WorkSchedule::orderBy('is_default', 'desc')->orderBy('updated_at', 'desc')->get();
        return view('work-schedule.index', $data);
    }

    public function create()
    {
        return view('work-schedule.create');
    }

    public function store(StoreWorkScheduleRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->is_default == 1 ? WorkSchedule::where('is_default', 1)->update(['is_default' => null]) : '';
            WorkSchedule::create($request->validated());
            DB::commit();
            return back()->with('success', 'Work Schedule has been created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(WorkSchedule $work_schedule)
    {
        $data['work_schedule'] = $work_schedule;
        return view('work-schedule.edit', $data);
    }

    public function update(UpdateWorkScheduleRequest $request, WorkSchedule $work_schedule)
    {
        DB::beginTransaction();
        try {
            if ($request->is_default == 1) {
                $default_work_schedule = WorkSchedule::where('is_default', 1)->first();
                if ($default_work_schedule && $default_work_schedule->id != $work_schedule->id) {
                    $default_work_schedule->update(['is_default' => null]);
                }
            }
            $data = $request->validated();
            $request->shift ? : $data['shift'] = 'day'; 
            $request->is_default ? : $data['is_default'] = null; 
            $work_schedule->update($data);
            DB::commit();
            return back()->with('success', 'Work Schedule has been updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(WorkSchedule $work_schedule)
    {
        try {
            $work_schedule->delete();
            return redirect()->route('work-schedule.index')->with('success', 'Work Schedule has been deleted');
        } catch (Exception $e) {
            return redirect()->route('work-schedule.index')->with('error', $e->getMessage());
        }
    }
}
