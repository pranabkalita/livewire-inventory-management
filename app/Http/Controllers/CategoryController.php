<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name'
        ]);

        Category::create($validated);

        return to_route('categories.index')->with('message', 'Category created successfully !');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
            'status' => 'required'
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
