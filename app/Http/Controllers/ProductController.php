<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('supplier', 'category', 'unit')->orderBy('id', 'desc')->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $suppliers = Supplier::activeStatus()->get();
        $categories = Category::activeStatus()->get();
        $units = Unit::activeStatus()->get();

        return view('products.create', compact('suppliers', 'categories', 'units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|unique:products,name',
            'supplier_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'unit_id' => 'required|numeric'
        ]);

        Product::create($validated);

        return to_route('products.index')->with('message', 'Product created successfully !');
    }

    public function edit(Product $product)
    {
        $suppliers = Supplier::activeStatus()->get();
        $categories = Category::activeStatus()->get();
        $units = Unit::activeStatus()->get();

        return view('products.edit', compact('product', 'suppliers', 'categories', 'units'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|unique:products,name,' . $product->id,
            'supplier_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'unit_id' => 'required|numeric'
        ]);

        $product->update($validated);

        return to_route('products.index')->with('message', 'Product updated successfully !');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('products.index')->with('message', 'Product deleted successfully !');
    }
}
