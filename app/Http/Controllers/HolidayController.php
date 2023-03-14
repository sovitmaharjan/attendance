<?php

namespace App\Http\Controllers;

use App\Http\Requests\Holiday\StoreHolidayRequest;
use App\Http\Requests\Holiday\UpdateHolidayRequest;
use App\Models\Holiday;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HolidayController extends Controller
{
    public function index()
    {
        $data['holiday'] = Holiday::all();
        return view('holiday.index', $data);
    }

    public function create()
    {
        return view('holiday.create');
    }

    public function store(StoreHolidayRequest $request)
    {
        try {
            DB::beginTransaction();
            $difference = Carbon::parse($request->to_date)->diffInDays(Carbon::parse($request->from_date));
            $data = $request->validated();
            $data['quantity'] = $difference + 1;
            $data['extra'] = [
                'nep_from_date' => $request->nep_from_date,
                'nep_to_date' => $request->nep_to_date
            ];
            $holiday = Holiday::create($data);
            for($i = 0; $i <= $difference; $i++) {
                $holiday->holiday_dates()->create([
                    'date' => Carbon::parse($request->from_date)->addDays($i)
                ]);
            }
            DB::commit();
            return back()->with('success', 'Holiday has been created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Holiday $holiday)
    {
        $data['holiday'] = $holiday;
        return view('holiday.edit', $data);
    }

    public function update(UpdateHolidayRequest $request, Holiday $holiday)
    {
        try {
            DB::beginTransaction();
            $difference = Carbon::parse($request->to_date)->diffInDays(Carbon::parse($request->from_date));
            $data = $request->validated();
            $data['quantity'] = $difference + 1;
            $data['extra'] = [
                'nep_from_date' => $request->nep_from_date,
                'nep_to_date' => $request->nep_to_date
            ];
            $holiday->update($data);
            $holiday->holiday_dates()->delete();
            for($i = 0; $i <= $difference; $i++) {
                $holiday->holiday_dates()->create([
                    'date' => Carbon::parse($request->from_date)->addDays($i)
                ]);
            }
            DB::commit();
            return back()->with('success', 'Holiday has been updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Holiday $holiday)
    {
        try {
            $holiday->delete();
            return redirect()->route('holiday.index')->with('success', 'Holiday has been deleted');
        } catch (Exception $e) {
            return redirect()->route('holiday.index')->with('error', $e->getMessage());
        }
    }
}
