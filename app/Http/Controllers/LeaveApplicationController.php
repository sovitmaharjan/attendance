<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Leave;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Support\Carbon;
use App\Models\LeaveApplication;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Leave\LeaveApplicationRequest;
use App\Models\LeaveAssignment;

class LeaveApplicationController extends Controller
{
    public function index()
    {
        $data['leave_applications'] = LeaveApplication::where([
            'employee_id' => auth()->id(),
            // 'year' => now('Y')
        ])->orderBy('created_at', 'desc')->get();
        return view('leave-application.index', $data);
    }

    public function create()
    {
        $data['branch'] = Branch::orderBy('name', 'asc')->get();
        $data['department'] = Department::orderBy('name', 'asc')->get();
        $data['employee'] = User::orderBy('firstname', 'asc')->get();
        $data['leave'] = Leave::all();
        return view('leave-application.create', $data);
    }

    public function store(LeaveApplicationRequest $request)
    {
        try {
            DB::beginTransaction();
            $difference = Carbon::parse($request->to_date)->diffInDays(Carbon::parse($request->from_date));
            $data = $request->validated();
            $data['leave_duration'] = $difference + 1;
            $data['leave_id'] = $request->leave;
            $data['extra'] = [
                'nepali_from_date' => $request->nepali_from_date,
                'nepali_to_date' => $request->nepali_to_date
            ];
            LeaveApplication::create($data);
            DB::commit();
            return redirect()->route('leave-application.index')->with('success', 'Your leave application has been submitted and waiting for approval');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(LeaveApplication $leave_application)
    {
        try {
            if ($leave_application->employee_id == auth()->id()) {
                if ($leave_application->status == LeaveApplication::PENDING || $leave_application->status == LeaveApplication::CANCELLED) {
                    $leave_application->delete();
                } else {
                    throw new Exception('Leave Application cannot be deleted as it has already been ' . $leave_application->status . '.');
                }
                return redirect()->route("leave-application.index")->with("success", "Leave Appliation has been deleted");
            } else {
                throw new Exception('Not found');
            }
        } catch (Exception $e) {
            return redirect()->route("leave-application.index")->with("error", $e->getMessage());
        }
    }

    public function getLeaveApplicationData()
    {
        try {
            $leave_assignment = LeaveAssignment::where([
                'leave_id' => request()->leave_id,
                'employee_id' => request()->employee_id
            ])->firstOrFail();
            $data['total_leave_assigned'] = $leave_assignment->allotted_days + $leave_assignment->carryover_days;
            $data['available'] = $leave_assignment->total_remaining_days;
            $data['used'] = $data['total_leave_assigned'] - $data['available'];
            $data['applied'] = LeaveApplication::where([
                'leave_id' => request()->leave_id,
                'employee_id' => request()->employee_id,
            ])->count();
            $data[LeaveApplication::PENDING] = LeaveApplication::where([
                'leave_id' => request()->leave_id,
                'employee_id' => request()->employee_id,
                'status' => LeaveApplication::PENDING,
            ])->count();
            $data[LeaveApplication::APPROVED] = LeaveApplication::where([
                'leave_id' => request()->leave_id,
                'employee_id' => request()->employee_id,
                'status' => LeaveApplication::APPROVED,
            ])->count();
            $data[LeaveApplication::CANCELLED] = LeaveApplication::where([
                'leave_id' => request()->leave_id,
                'employee_id' => request()->employee_id,
                'status' => LeaveApplication::CANCELLED,
            ])->count();
            return response()->json([
                'status' => 'success',
                'message' => 'Leave Data',
                'data' => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function checkLeaveApplicationDate()
    {
        $difference = Carbon::parse(request()->to_date)->diffInDays(Carbon::parse(request()->from_date));
        for ($i = 0; $i <= $difference; $i++) {
            $leave_application = LeaveApplication::where([
                'leave_id' => request()->leave_id,
                'employee_id' => request()->employee_id,
                'year' => now('Y'),
                'from_date' => Carbon::parse(request()->from_date)->addDays($i)
            ])->first();
            if ($leave_application) {
                $status = '';
                $message = '';
                if ($leave_application->status == LeaveApplication::PENDING) {
                    $status = 'Pending';
                    $message = 'Leave application for the date ' . $leave_application->from_date . ' is currently awaiting for approval.';
                }
                if ($leave_application->status == LeaveApplication::APPROVED) {
                    $status = 'Approved';
                    $message = 'Leave application for the date ' . $leave_application->from_date . ' has been approval';
                }
                if ($leave_application->status == LeaveApplication::CANCELLED) {
                    $status = 'Cancelled';
                    $message = 'Leave application for the date ' . $leave_application->from_date . ' has been cancelled';
                }
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                    'data' => $leave_application
                ], 200);
            }
        }
    }

    public function cancel($id)
    {
        try {
            $leave_application = LeaveApplication::find($id);
            if ($leave_application->status == LeaveApplication::CANCELLED) {
                throw new Exception('Leave application is already cancelled', 400);
            }
            if ($leave_application->status == LeaveApplication::APPROVED) {
                throw new Exception('Leave application is already approved', 400);
            }
            $leave_application->update(['status' => LeaveApplication::CANCELLED]);
            return redirect()->route("leave-application.index")->with("success", "Leave Appliation has been cancelled");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function approve($id)
    {
        try {
            $leave_application = LeaveApplication::find($id);
            if ($leave_application->status == LeaveApplication::CANCELLED) {
                throw new Exception('Leave is already cancelled', 400);
            }
            if ($leave_application->status == LeaveApplication::APPROVED) {
                throw new Exception('Leave is already approved', 400);
            }
            $difference = Carbon::parse('2022-11-17')->diffInDays(Carbon::parse('2022-11-17'));
            for ($i = 0; $i <= $difference; $i++) {
                $leave_application->leave_application_dates()->create([
                    'date' => Carbon::parse('2022-11-17')->addDays($i)
                ]);
            }
            LeaveAssignment::where([
                'leave_id' => 1,
                'employee_id' => 1
            ])->decrement('total_remaining_days', $difference + 1);
            $leave_application->update(['status' => LeaveApplication::APPROVED]);
            return redirect()->route("leave-application.index")->with("success", "Leave Appliation has been approved");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
