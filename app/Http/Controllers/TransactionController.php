<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Room;
use App\Models\ExtraCharge;

class TransactionController extends Controller
{
    
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $rooms = Room::all();
        $extraCharges = ExtraCharge::all();
        return view('transactions.create', compact('rooms', 'extraCharges'));
    }

    public function store(Request $request)
    {
        $transaction = new Transaction;
        $transaction->TransCode = $request->input('TransCode');
        $transaction->TransDate = $request->input('TransDate');
        $transaction->CustName = $request->input('CustName');
        $transaction->TotalRoomPrice = $request->input('TotalRoomPrice');
        $transaction->FinalTotal = $request->input('FinalTotal');
        $transaction->save();

        // Simpan detail transaksi
        $roomIDs = $request->input('roomIDs');
        $days = $request->input('days');
        $extraCharges = $request->input('extraCharges');
        $quantities = $request->input('quantities');

        foreach ($roomIDs as $index => $roomID) {
            $detailTransaction = new DetailTransaction;
            $detailTransaction->TransID = $transaction->id;
            $detailTransaction->RoomID = $roomID;
            $detailTransaction->Days = $days[$index];
            $detailTransaction->ExtraCharge = $extraCharges[$index];
            $detailTransaction->Quantity = $quantities[$index];
            $detailTransaction->save();
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully');
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.show', compact('transaction'));
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $rooms = Room::all();
        $extraCharges = ExtraCharge::all();
        return view('transactions.edit', compact('transaction', 'rooms', 'extraCharges'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->TransCode = $request->input('TransCode');
        $transaction->TransDate = $request->input('TransDate');
        $transaction->CustName = $request->input('CustName');
        $transaction->TotalRoomPrice = $request->input('TotalRoomPrice');
        $transaction->FinalTotal = $request->input('FinalTotal');
        $transaction->save();

        // Update detail transaksi
        $roomIDs = $request->input('roomIDs');
        $days = $request->input('days');
        $extraCharges = $request->input('extraCharges');
        $quantities = $request->input('quantities');

        DetailTransaction::where('TransID', $id)->delete(); // Hapus detail transaksi yang ada

        foreach ($roomIDs as $index => $roomID) {
            $detailTransaction = new DetailTransaction;
            $detailTransaction->TransID = $transaction->id;
            $detailTransaction->RoomID = $roomID;
            $detailTransaction->Days = $days[$index];
            $detailTransaction->ExtraCharge = $extraCharges[$index];
            $detailTransaction->Quantity = $quantities[$index];
            $detailTransaction->save();
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        // Hapus detail transaksi yang terkait
        DetailTransaction::where('TransID', $id)->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
    }
    public function report(Request $request)
    {
        $roomType = $request->input('room_type');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $transactions = Transaction::query()->when($roomType, function ($query) use ($roomType) {
                $query->whereHas('room', function ($query) use ($roomType) {
                $query->where('RoomTypeID', $roomType);
                });
            })->when($startDate, function ($query) use ($startDate) {
            $query->whereDate('TransDate', '>=', $startDate);
        })->when($endDate, function ($query) use ($endDate) {
            $query->whereDate('TransDate', '<=', $endDate);
        })->get();
            $roomTypes = RoomType::all();
                return view('report', compact('transactions', 'roomTypes'));
    }
}