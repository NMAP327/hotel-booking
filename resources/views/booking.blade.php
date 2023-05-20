<form action="{{ route('transaction.store') }}" method="POST">
    @csrf

    <div>
        <label for="room">Room:</label>
        <select name="room" id="room">
            @foreach($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->RoomName }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="duration">Duration (in days):</label>
        <input type="number" name="duration" id="duration" min="1" required>
    </div>

    <div>
        <label for="extra_charge">Extra Charge:</label>
        @foreach($extraCharges as $extraCharge)
            <div>
                <input type="checkbox" name="extra_charge[]" id="extra_charge_{{ $extraCharge->id }}" value="{{ $extraCharge->id }}">
                <label for="extra_charge_{{ $extraCharge->id }}">{{ $extraCharge->name }} ({{ $extraCharge->price }})</label>
            </div>
        @endforeach
    </div>

    <button type="submit">Book</button>
</form>
