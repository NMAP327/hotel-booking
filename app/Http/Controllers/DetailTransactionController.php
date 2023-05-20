<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use App\Models\Room;
use App\Models\ExtraCharge;

class DetailTransactionController extends Controller
{
    public function create()
    {
        $rooms = Room::all();
        $extraCharges = ExtraCharge::all();
        return view('detail_transactions.create', compact('rooms', 'extraCharges'));
    }

    public function store(Request $request)
    {
        $detailTransaction = new DetailTransaction;
        $detailTransaction->TransID = $request->input('TransID');
        $detailTransaction->RoomID = $request->input('RoomID');
        $detailTransaction->Days = $request->input('Days');
        $detailTransaction->ExtraCharge = $request->input('ExtraCharge');
        $detailTransaction->Quantity = $request->input('Quantity');
        $detailTransaction->save();

        return redirect()->route('transactions.show', $detailTransaction->TransID)->with('success', 'Detail Transaction created successfully');
    }

    public function edit($id)
    {
        $detailTransaction = DetailTransaction::findOrFail($id);
        $rooms = Room::all();
        $extraCharges = ExtraCharge::all();
        return view('detail_transactions.edit', compact('detailTransaction', 'rooms', 'extraCharges'));
    }

    public function update(Request $request, $id)
    {
        $detailTransaction = DetailTransaction::findOrFail($id);
        $detailTransaction->TransID = $request->input('TransID');
        $detailTransaction->RoomID = $request->input('RoomID');
        $detailTransaction->Days = $request->input('Days');
        $detailTransaction->ExtraCharge = $request->input('ExtraCharge');
        $detailTransaction->Quantity = $request->input('Quantity');
        $detailTransaction->save();

        return redirect()->route('transactions.show', $detailTransaction->TransID)->with('success', 'Detail Transaction updated successfully');
    }

    public function destroy($id)
    {
        $detailTransaction = DetailTransaction::findOrFail($id);
        $detailTransaction->delete();

        return redirect()->back()->with('success', 'Detail Transaction deleted successfully');
    }
}
