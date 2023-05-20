<form action="{{ route('transaction.report') }}" method="GET">
    <div>
        <label for="room_type">Room Type:</label>
        <select name="room_type" id="room_type">
            <option value="">All</option>
            @foreach($roomTypes as $roomType)
                <option value="{{ $roomType->id }}">{{ $roomType->RoomType }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date">
    </div>

    <div>
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date">
    </div>

    <button type="submit">Generate Report</button>
</form>

<table>
    <thead>
        <tr>
            <th>Transaction Code</th>
            <th>Date</th>
            <th>Customer Name</th>
            <th>Room Type</th>
            <th>Total Room Price</th>
            <th>Total Extra Charge</th>
            <th>Final Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->TransCode }}</td>
                <td>{{ $transaction->TransDate }}</td>
                <td>{{ $transaction->CustName }}</td>
                <td>{{ $transaction->room->roomType->RoomType }}</td>
                <td>{{ $transaction->TotalRoomPrice }}</td>
                <td>{{ $transaction->TotalExtraCharge }}</td>
                <td>{{ $transaction->FinalTotal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
