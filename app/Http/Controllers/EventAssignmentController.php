<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventAssignmentRequest;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventAssignmentController extends Controller
{

    public function create($id=null)
    {
        $data['events'] = Event::where('status', 1)->get();
        $data['employees'] = User::all();
        return view('event_assignment.create', $data);
    }

    public function assignMultipleEvent(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->event_id as $event_id) {
                $event = Event::where('id', $event_id)->first();
                if ($event) {
                    $event->employees()->sync($request->employee_id);
                }
            }
            DB::commit();
            return back()->with('success', 'Event assigned to employee successfully');
        } catch (\Exception$e) {
            DB::rollBack();
            return back()->with("error", $e->getMessage());
        }
    }

    public function store(EventAssignmentRequest $request)
    {
        try {
            DB::beginTransaction();
            $event = Event::where('id', $request->event_id)->first();
            if ($event) {
                $event->employees()->sync($request->employee_id);
            }
            DB::commit();
            return back()->with('success', 'Event assigned to employee successfully');
        } catch (\Exception$e) {
            DB::rollBack();
            return back()->with("error", $e->getMessage());
        }
    }

    public function event_employee_list($event_id)
    {
        $event = Event::where('id', $event_id)->first();
        if($event){
            $data['event'] = $event;
            $data['employees'] = $event->employees;
            return view('event_assignment.employee_list', $data);
        }
        return "<h1>No Data</h1>";
    }

}
