<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'desc')->paginate(10);

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:suppliers',
            'phone_number' => 'required|unique:suppliers',
            'address' => 'required'
        ]);

        Supplier::create($validated);

        return to_route('suppliers.index')->with('message', 'Supplier created successfully !');
    }

    public function edit(Request $request, Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
            'phone_number' => 'required|unique:suppliers,phone_number,' . $supplier->id,
            'address' => 'required',
            'status' => 'required'
        ]);

        $supplier->update($validated);

        return to_route('suppliers.index')->with('message', 'Supplier updated successfully !');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return to_route('suppliers.index')->with('message', 'Supplier deleted successfully !');
    }
}
