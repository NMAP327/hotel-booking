<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $room = new Room;
        $room->RoomTypeID = $request->input('RoomTypeID');
        $room->RoomName = $request->input('RoomName');
        $room->Area = $request->input('Area');
        $room->Price = $request->input('Price');
        $room->Facility = $request->input('Facility');
        $room->save();

        return redirect()->route('rooms.index')->with('success', 'Room created successfully');
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.show', compact('room'));
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->RoomTypeID = $request->input('RoomTypeID');
        $room->RoomName = $request->input('RoomName');
        $room->Area = $request->input('Area');
        $room->Price = $request->input('Price');
        $room->Facility = $request->input('Facility');
        $room->save();

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully');
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully');
    }
}
