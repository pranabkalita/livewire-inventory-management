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

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('products.index')->with('message', 'Product deleted successfully !');
    }
}
