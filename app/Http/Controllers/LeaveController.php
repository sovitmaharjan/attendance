<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveRequest;
use App\Models\Leave;
use App\Models\LeaveType;
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
        $data['leave_type'] = LeaveType::all();
        return view('leave.create', $data);
    }

    public function store(LeaveRequest $request)
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
        $data['leave_type'] = LeaveType::all();
        return view('leave.edit', $data);
    }

    public function update(LeaveRequest $request, Leave $leave)
    {
        try {
            $leave->update($request->validated());
            return redirect()->route('leave.index')->with('success', 'Leave has been updated');
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
