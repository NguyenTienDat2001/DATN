<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function createevent(Request $request)
    {
        $event = Event::create([
            'des' => $request->get('des'),
            'value' => $request->get('value'),
            'point' => $request->get('point'),
            'status' => '0',
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'sucessfully',
            'event' => $event,
        ]);
    }

    public function event()
    {
        $events = Event::all();
        return response()->json([
            'status' => 200,
            'message' => 'sucessfully',
            'event' => $events,
        ]);
    }

    public function update(Request $request, $id)
    {
        Event::where('id', $id)->update($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'sucessfully',
        ]);
    }
}
