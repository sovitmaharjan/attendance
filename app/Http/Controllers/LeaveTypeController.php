<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaveTypeRequest;
use App\Models\LeaveType;
use Exception;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $data['leave_type'] = LeaveType::all();
        return view('leave-type.index', $data);
    }

    public function create()
    {
        return view('leave-type.create');
    }

    public function store(LeaveTypeRequest $request)
    {
        try {
            $leave_type = LeaveType::where('title', $request->title)->withTrashed()->first();
            if ($leave_type) {
                $leave_type->restore();
                return back()->with('success', 'Leave type has been created');
            }
            LeaveType::create($request->validated());
            return back()->with('success', 'Leave type has been created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(LeaveType $leave_type)
    {
        $data['leave_type'] = $leave_type;
        return view('leave-type.edit', $data);
    }

    public function update(LeaveTypeRequest $request, LeaveType $leave_type)
    {
        try {
            $leave_type->update($request->validated());
            return redirect()->route('leave-type.index')->with('success', 'Leave type has been updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(LeaveType $leave_type)
    {
        try {
            $leave_type->delete();
            return redirect()->route('leave-type.index')->with('success', 'Leave type has been deleted');
        } catch (Exception $e) {
            return redirect()->route('leave-type.index')->with('error', $e->getMessage());
        }
    }
}
