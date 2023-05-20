@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Rooms</h1>
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add Room</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Room Type</th>
                    <th>Room Name</th>
                    <th>Area</th>
                    <th>Price</th>
                    <th>Facility</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->roomType->RoomType }}</td>
                        <td>{{ $room->RoomName }}</td>
                        <td>{{ $room->Area }}</td>
                        <td>{{ $room->Price }}</td>
                        <td>{{ $room->Facility }}</td>
                        <td>
                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-primary">View</a>
                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                                style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this room?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
