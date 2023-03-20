<?php

namespace App\Http\Controllers;

use App\Http\Requests\Leave\StoreLeaveRequest;
use App\Http\Requests\Leave\UpdateLeaveRequest;
use App\Models\Leave;
use Exception;

class LeaveController extends Controller
{
    public function index()
    {
        $data['leave'] = Leave::all();
        return view('leave.index', $data);
    }

    public function create()
    {
        return view('leave.create');
    }

    public function show(Leave $leave)
    {
        return response()->json($leave);
    }

    public function store(StoreLeaveRequest $request)
    {
        try {
            Leave::create($request->validated());
            return back()->with('success', 'Leave has been created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Leave $leave)
    {
        $data['leave'] = $leave;
        return view('leave.edit', $data);
    }

    public function update(UpdateLeaveRequest $request, Leave $leave)
    {
        try {
            $leave->update($request->validated());
            return back()->with('success', 'Leave has been updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Leave $leave)
    {
        try {
            $leave->delete();
            return redirect()->route('leave.index')->with('success', 'Leave has been deleted');
        } catch (Exception $e) {
            return redirect()->route('leave.index')->with('error', $e->getMessage());
        }
    }
}
