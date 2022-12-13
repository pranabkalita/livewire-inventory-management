<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Livewire\Component;

class Create extends Component
{
    public ?Product $product = null;

    public $suppliers = [];
    public $categories = [];
    public $units = [];

    public $name = '';
    public $supplier_id = '';
    public $category_id = '';
    public $unit_id = '';

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|min:2',
            'supplier_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'unit_id' => 'required|numeric'
        ]);

        if ($this->product) {
            $this->product->update($validated);
        } else {
            Product::create($validated);
        }

        return to_route('products.index')->with('message', 'Product created successfully !');
    }

    public function mount()
    {
        $this->name = $this->product ? $this->product->name : '';
        $this->supplier_id = $this->product ? $this->product->supplier_id : '';
        $this->category_id = $this->product ? $this->product->category_id : '';
        $this->unit_id = $this->product ? $this->product->unit_id : '';

        $this->suppliers = Supplier::activeStatus()->orderBy('name', 'asc')->get();
        if ($this->product) {
            $this->categories = Category::where('supplier_id', '=', $this->product->supplier_id)
                ->activeStatus()
                ->orderBy('name', 'asc')
                ->get();
        }
        $this->units = Unit::activeStatus()->orderBy('name', 'asc')->get();
    }

    public function updatedSupplierId($value)
    {
        $this->categories = Category::where('supplier_id', '=', $value)
            ->activeStatus()
            ->orderBy('name', 'asc')
            ->get();

        $this->category_id = '';
    }

    public function render()
    {
        return view('livewire.products.create');
    }
}
