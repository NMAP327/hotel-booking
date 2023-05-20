@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Room</h1>
        <form action="{{ route('rooms.update', $room->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="roomType">Room Type</label>
                <select name="RoomTypeID" id="roomType" class="form-control">
                    @foreach ($roomTypes as $roomType)
                        <option value="{{ $roomType->id }}" {{ $room->RoomTypeID == $roomType->id ? 'selected' : '' }}>
                            {{ $roomType->RoomType }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="roomName">Room Name</label>
                <input type="text" name="RoomName" id="roomName" class="form-control" value="{{ $room->RoomName }}">
            </div>
            <div class="form-group">
                <label for="area">Area</label>
                <input type="text" name="Area" id="area" class="form-control" value="{{ $room->Area }}">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="Price" id="price" class="form-control" value="{{ $room->Price }}">
            </div>
            <div class="form-group">
                <label for="facility">Facility</label>
                <textarea name="Facility" id="facility" class="form-control">{{ $room->Facility }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Room</button>
        </form>
    </div>
@endsection
