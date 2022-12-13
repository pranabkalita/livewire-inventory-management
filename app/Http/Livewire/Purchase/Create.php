<?php

namespace App\Http\Livewire\Purchase;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\Component;

class Create extends Component
{
    public $date = '';
    public $purchaseNumber = '';
    public $supplierId = '';
    public $categoryId = '';
    public $productId = '';

    public $suppliers = '';
    public $categories = '';
    public $products = '';

    public $totalPrice = '';

    // public $selectedProducts = [
    //     ['id' => 1, 'name' => 'A', 'quantity' => 1, 'price' => 20, 'amount' => 20],
    //     ['id' => 2, 'name' => 'B', 'quantity' => 1, 'price' => 40, 'amount' => 40]
    // ];

    public $selectedProducts = [];

    public function save()
    {
        $this->validate([
            'date' => 'required',
            'purchaseNumber' => 'required',
            'supplierId' => 'required',
            'categoryId' => 'required',
        ]);

        foreach ($this->selectedProducts as $key => $product) {
            if (!empty($product['id']) || !empty($product['quantity']) || $product['quantity'] > 0 || $product['price']) {
                $data = [
                    'purchase_number' => $this->purchaseNumber,
                    'date' => $this->date,
                    'supplier_id' => $this->supplierId,
                    'category_id' => $this->categoryId,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'amount' => $product['amount']
                ];

                Purchase::create($data);
            }
        }

        return to_route('purchases.index')->with('message', 'New purchase made successfully !');
    }

    public function updatedSelectedProducts()
    {
        $this->calculatePrice();
    }

    public function calculatePrice()
    {
        $totalPrice = 0;
        foreach ($this->selectedProducts as $key => $product) {
            $this->selectedProducts[$key] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'amount' => $product['quantity'] * $product['price']
            ];
            $totalPrice += $product['quantity'] * $product['price'];
        }

        $this->totalPrice = $totalPrice;
    }

    public function removeFromList($key)
    {
        unset($this->selectedProducts[$key]);
        $this->calculatePrice();
    }

    public function addToList()
    {
        // dd($this->selectedProducts);
        $product = Product::find($this->productId);

        $this->selectedProducts[] = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => 0
        ];
    }

    public function mount()
    {
        $this->suppliers = Supplier::activeStatus()->orderBy('name', 'asc')->get();
    }

    public function updatedSupplierId($value)
    {
        $this->categories = Category::where('supplier_id', '=', $value)
            ->activeStatus()
            ->orderBy('name', 'asc')
            ->get();

        $this->category_id = '';
        $this->products = '';
    }

    public function updatedCategoryId($value)
    {
        $this->products = Product::where(
            [
                'category_id' => $value,
                'supplier_id' => $this->supplierId
            ]
        )->activeStatus()
            ->orderBy('name', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.purchase.create');
    }
}
