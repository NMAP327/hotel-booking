@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Room</h1>
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="roomType">Room Type</label>
                <select name="RoomTypeID" id="roomType" class="form-control">
                    @foreach ($roomTypes as $roomType)
                        <option value="{{ $roomType->id }}">{{ $roomType->RoomType }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="roomName">Room Name</label>
                <input type="text" name="RoomName" id="roomName" class="form-control">
            </div>
            <div class="form-group">
                <label for="area">Area</label>
                <input type="text" name="Area" id="area" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="Price" id="price" class="form-control">
            </div>
            <div class="form-group">
                <label for="facility">Facility</label>
                <textarea name="Facility" id="facility" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Room</button>
        </form>
    </div>
@endsection
