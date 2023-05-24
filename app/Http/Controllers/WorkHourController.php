<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkHour\StoreWorkHourRequest;
use App\Http\Requests\WorkHour\UpdateWorkHourRequest;
use App\Models\WorkHour;
use Exception;
use Illuminate\Support\Facades\DB;

class WorkHourController extends Controller
{
    public function index()
    {
        $data['work_hour'] = WorkHour::orderBy('is_default', 'desc')->orderBy('updated_at', 'desc')->get();
        return view('work-hour.index', $data);
    }

    public function create()
    {
        return view('work-hour.create');
    }

    public function store(StoreWorkHourRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->is_default == 1 ? WorkHour::where('is_default', 1)->update(['is_default' => null]) : '';
            WorkHour::create($request->validated());
            DB::commit();
            return back()->with('success', 'Work Hour has been created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(WorkHour $work_hour)
    {
        $data['work_hour'] = $work_hour;
        return view('work-hour.edit', $data);
    }

    public function update(UpdateWorkHourRequest $request, WorkHour $work_hour)
    {
        DB::beginTransaction();
        try {
            if ($request->is_default == 1) {
                $default_work_hour = WorkHour::where('is_default', 1)->first();
                if ($default_work_hour && $default_work_hour->id != $work_hour->id) {
                    $default_work_hour->update(['is_default' => null]);
                }
            }
            $data = $request->validated();
            $request->shift ? : $data['shift'] = 'day'; 
            $request->is_default ? : $data['is_default'] = null; 
            $work_hour->update($data);
            DB::commit();
            return back()->with('success', 'Work Hour has been updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(WorkHour $work_hour)
    {
        try {
            $work_hour->delete();
            return redirect()->route('work-hour.index')->with('success', 'Work Hour has been deleted');
        } catch (Exception $e) {
            return redirect()->route('work-hour.index')->with('error', $e->getMessage());
        }
    }
}
