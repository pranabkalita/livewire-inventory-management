<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseApprovalController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier', 'category', 'product')
            ->where('status', Purchase::STATUS['PENDING'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('purchases.approval.index', compact('purchases'));
    }
}
