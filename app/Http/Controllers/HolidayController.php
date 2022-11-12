<?php

namespace App\Http\Controllers;

use App\Http\Requests\HolidayRequest;
use App\Models\Holiday;
use Exception;
use Illuminate\Http\Request;

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

    public function store(HolidayRequest $request)
    {
        try {
            Holiday::create($request->validated());
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

    public function update(HolidayRequest $request, Holiday $holiday)
    {
        try {
            $holiday->update($request->validated());
            return redirect()->route('holiday.index')->with('success', 'Holiday has been updated');
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
