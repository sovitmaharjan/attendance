<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftRequest;
use App\Models\Shift;
use Exception;

class ShiftController extends Controller
{
    public function index()
    {
        $data['shift'] = Shift::all();
        return view('shift.index', $data);
    }

    public function create()
    {
        return view('shift.create');
    }

    public function store(ShiftRequest $request)
    {
        try {
            Shift::create($request->validated());
            return back()->with('success', 'Shift has been created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Shift $shift)
    {
        $data['shift'] = $shift;
        return view('shift.edit', $data);
    }

    public function update(ShiftRequest $request, Shift $shift)
    {
        try {
            $shift->update($request->validated());
            return redirect()->route('shift.index')->with('success', 'Shift has been updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Shift $shift)
    {
        try {
            $shift->delete();
            return redirect()->route('shift.index')->with('success', 'Shift has been deleted');
        } catch (Exception $e) {
            return redirect()->route('shift.index')->with('error', $e->getMessage());
        }
    }
}
