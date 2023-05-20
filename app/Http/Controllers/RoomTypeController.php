<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::all();
        return view('room_types.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('room_types.create');
    }

    public function store(Request $request)
    {
        $roomType = new RoomType;
        $roomType->RoomType = $request->input('RoomType');
        $roomType->save();

        return redirect()->route('room-types.index')->with('success', 'Room type created successfully');
    }

    public function show($id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('room_types.show', compact('roomType'));
    }

    public function edit($id)
    {
        $roomType = RoomType::findOrFail($id);
        return view('room_types.edit', compact('roomType'));
    }

    public function update(Request $request, $id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->RoomType = $request->input('RoomType');
        $roomType->save();

        return redirect()->route('room-types.index')->with('success', 'Room type updated successfully');
    }

    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();

        return redirect()->route('room-types.index')->with('success', 'Room type deleted successfully');
    }
}
