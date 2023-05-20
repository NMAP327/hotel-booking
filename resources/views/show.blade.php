@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Room Details</h1>
        <table class="table mt-3">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $room->id }}</td>
                </tr>
                <tr>
                    <th>Room Type</th>
                    <td>{{ $room->roomType->RoomType }}</td>
                </tr>
                <tr>
                    <th>Room Name</th>
                    <td>{{ $room->RoomName }}</td>
                </tr>
                <tr>
                    <th>Area</th>
                    <td>{{ $room->Area }}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>{{ $room->Price }}</td>
                </tr>
                <tr>
                    <th>Facility</th>
                    <td>{{ $room->Facility }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display: inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this room?')">Delete</button>
        </form>
    </div>
@endsection
