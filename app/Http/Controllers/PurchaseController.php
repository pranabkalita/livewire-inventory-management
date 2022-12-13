<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier', 'category', 'product')->orderBy('id', 'desc')->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        return view('purchases.create');
    }

    public function update(Request $request, Purchase $purchase)
    {
        $purchase->update([
            'status' => Purchase::STATUS['APPROVED'],
        ]);

        return to_route('approve.index')->with('message', 'Purchase has been approved.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return to_route('purchases.index')->with('message', 'Purchase has been deleted.');
    }
}
