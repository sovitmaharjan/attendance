<?php

namespace App\Http\Controllers;

use App\Http\Requests\HolidayTypeRequest;
use App\Models\HolidayType;
use Exception;

class HolidayTypeController extends Controller
{
    public function index()
    {
        $data['holiday_type'] = HolidayType::all();
        return view('holiday-type.index', $data);
    }

    public function create()
    {
        return view('holiday-type.create');
    }

    public function store(HolidayTypeRequest $request)
    {
        try {
            HolidayType::create($request->validated());
            return back()->with('success', 'Holiday type has been created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(HolidayType $holiday_type)
    {
        $data['holiday_type'] = $holiday_type;
        return view('holiday-type.edit', $data);
    }

    public function update(HolidayTypeRequest $request, HolidayType $holiday_type)
    {
        try {
            $holiday_type->update($request->validated());
            return redirect()->route('holiday-type.index')->with('success', 'Holiday type has been updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(HolidayType $holiday_type)
    {
        try {
            $holiday_type->delete();
            return redirect()->route('holiday-type.index')->with('success', 'Holiday type has been deleted');
        } catch (Exception $e) {
            return redirect()->route('holiday-type.index')->with('error', $e->getMessage());
        }
    }
}
