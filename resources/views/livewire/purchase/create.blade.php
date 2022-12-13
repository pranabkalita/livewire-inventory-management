<div>
    <form class="mt-6 space-y-6" wire:submit.prevent="save">
        @csrf

        <div class="flex justify-between">
            <div class="w-1/4">
                <x-input-label for="date" :value="__('Date')" />
                <x-text-input id="date" type="date" class="mt-1 block w-full" wire:model.lazy="date" />
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>

            <div class="w-1/4">
                <x-input-label for="purchase_number" :value="__('Purchase number')" />
                <x-text-input id="purchase_number" type="text" class="mt-1 block w-full"
                    wire:model.lazy="purchaseNumber" />
                <x-input-error :messages="$errors->get('purchaseNumber')" class="mt-2" />
            </div>

            <div class="w-1/4">
                <x-input-label for="supplier" :value="__('Supplier')" />
                <x-input-select id="supplier" wire:model="supplierId" class="flex w-full">
                    <option value="">-- Select --</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </x-input-select>
                <x-input-error :messages="$errors->get('supplierId')" class="mt-2" />
            </div>
        </div>

        <div class="flex justify-between">
            @if (!empty($categories))
                <div class="w-1/4">
                    <x-input-label for="categoryId" :value="__('Category')" />
                    <x-input-select id="categoryId" wire:model="categoryId" class="flex w-full">
                        <option value="">-- Select --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-input-select>
                    <x-input-error :messages="$errors->get('categoryId')" class="mt-2" />
                </div>
            @endif

            @if (!empty($products))
                <div class="w-1/4">
                    <x-input-label for="product_id" :value="__('Product')" />
                    <x-input-select id="product_id" wire:model="productId" class="flex w-full">
                        <option value="">-- Select --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </x-input-select>
                    <x-input-error :messages="$errors->get('productId')" class="mt-2" />
                </div>
            @endif

            <div class="w-1/4 mt-6">
                @if ($productId)
                    <x-primary-button wire:click.prevent="addToList">Add</x-primary-button>
                @endif
            </div>
        </div>

        @if (count($selectedProducts))
            <div class="flex justify-between mt-4">
                <div class="font-semibold text-lg">Product Name</div>
                <div class="font-semibold text-lg">Price</div>
                <div class="font-semibold text-lg">Quantity</div>
                <div class="font-semibold text-lg">Amount (₹)</div>
                <div class="font-semibold text-lg">Action</div>
            </div>
            @foreach ($selectedProducts as $key => $product)
                <div class="flex justify-between">
                    <div>
                        <input type="text" wire:model="selectedProducts.{{ $key }}.name" readonly>
                    </div>
                    <div>
                        <input type="text" wire:model="selectedProducts.{{ $key }}.price">
                    </div>
                    <div>
                        <input type="text" wire:model="selectedProducts.{{ $key }}.quantity">
                    </div>
                    <div>
                        <input readonly type="text" wire:model="selectedProducts.{{ $key }}.amount">
                    </div>
                    <div>
                        <a href="#" wire:click.prevent="removeFromList({{ $key }})"
                            class="hover:underline text-red-500">Remove</a>
                    </div>
                </div>
            @endforeach
            <div class="flex justify-between">
                <div></div>
                <div></div>
                <div>Total</div>
                <div class="font-bold text-lg">₹ {{ $totalPrice }}</div>
                <div></div>
            </div>
        @endif

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>
