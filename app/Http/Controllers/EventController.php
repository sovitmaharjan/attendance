<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Exception;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $data['events'] = Event::all();
        return view('event.index', $data);
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(EventRequest $request)
    {
        try{
            DB::beginTransaction();
            $extras = [
                'nepali_from_date' => $request->nepali_from_date,
                'nepali_to_date' => $request->nepali_to_date,
            ];
            $request->only((new Event)->getFillable());
            $request->request->add([
                'extras' => $extras
            ]);
            $event = Event::create($request->all());
            DB::commit();
            return back()->with('success', 'Event created successfully');
        } catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Event $event)
    {
        $data['event'] = $event;
        return view('event.edit', $data);
    }

    public function update(EventRequest $request, Event $event)
    {
        try{
            DB::beginTransaction();
            $extras = [
                'nepali_from_date' => $request->nepali_from_date,
                'nepali_to_date' => $request->nepali_to_date,
            ];
            $request->only((new Event)->getFillable());
            $request->request->add([
                'extras' => $extras,
            ]);
            $event->update($request->all());
            DB::commit();
            return redirect()->route('event.index')->with('success', 'Event updated successfully');
        } catch(Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Event $event)
    {
        try{
            $event->delete();
            return redirect()->route('event.index')->with('success', 'Event deleted successfully');
        } catch(Exception $e){
            return redirect()->route('event.index')->with('error', $e->getMessage());
        }
    }
}
