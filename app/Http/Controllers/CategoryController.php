<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('supplier')->orderBy('id', 'desc')->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $suppliers = Supplier::activeStatus()->orderBy('name', 'asc')->get();

        return view('categories.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'supplier_id' => 'required'
        ]);

        Category::create($validated);

        return to_route('categories.index')->with('message', 'Category created successfully !');
    }

    public function edit(Category $category)
    {
        $suppliers = Supplier::activeStatus()->orderBy('name', 'asc')->get();

        return view('categories.edit', compact('category', 'suppliers'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'required',
            'supplier_id' => 'required'
        ]);

        $category->update($validated);

        return to_route('categories.index')->with('message', 'Category updated successfully !');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('categories.index')->with('message', 'Category deleted successfully !');
    }
}
