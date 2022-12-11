<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('id', 'desc')->paginate(10);

        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string'
        ]);

        Unit::create($validated);

        return to_route('units.index')->with('message', 'Unit created successfully !');
    }

    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required'
        ]);

        $unit->update($validated);

        return to_route('units.index')->with('message', 'Unit updated successfully !');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return to_route('units.index')->with('message', 'Unit deleted successfully !');
    }
}
