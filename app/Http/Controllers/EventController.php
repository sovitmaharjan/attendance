<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Models\Event;
use Exception;
use Illuminate\Support\Carbon;
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

    public function store(StoreEventRequest $request)
    {
        try {
            DB::beginTransaction();
            $difference = Carbon::parse($request->to_date)->diffInDays(Carbon::parse($request->from_date));
            $request->request->add(['quantity' => $difference + 1]);
            $extra = [
                'nepali_from_date' => $request->nepali_from_date,
                'nepali_to_date' => $request->nepali_to_date,
            ];
            $request->only((new Event)->getFillable());
            $request->request->add([
                'extra' => $extra
            ]);
            $event = Event::create($request->all());
            for($i = 0; $i <= $difference; $i++) {
                $event->eventDates()->create([
                    'date' => Carbon::parse($request->from_date)->addDays($i)
                ]);
            }
            DB::commit();
            return back()->with('success', 'Event created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Event $event)
    {
        $data['event'] = $event;
        return view('event.edit', $data);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        try {
            DB::beginTransaction();
            $difference = Carbon::parse($request->to_date)->diffInDays(Carbon::parse($request->from_date));
            $request->request->add(['quantity' => $difference + 1]);
            $extra = [
                'nepali_from_date' => $request->nepali_from_date,
                'nepali_to_date' => $request->nepali_to_date,
            ];
            $request->only((new Event)->getFillable());
            $request->request->add([
                'extra' => $extra,
            ]);
            $event->update($request->all());
            $event->eventDates()->delete();
            for($i = 0; $i <= $difference; $i++) {
                $event->eventDates()->create([
                    'date' => Carbon::parse($request->from_date)->addDays($i)
                ]);
            }
            DB::commit();
            return back()->with('success', 'Event updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Event $event)
    {
        try {
            $event->delete();
            return redirect()->route('event.index')->with('success', 'Event deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('event.index')->with('error', $e->getMessage());
        }
    }
}
