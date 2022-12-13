<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="flex justify-start">
                    <x-link-button href="{{ route('products.index') }}" title="Back" />
                </div>

                <livewire:products.create :product="$product" />

                {{-- <form method="post" action="{{ route('products.update', $product->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            value="{{ old('name', $product->name) }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="supplier_id" :value="__('Supplier')" />
                        <x-input-select name="supplier_id" id="supplier_id">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" @if ($product->supplier_id === $supplier->id) selected @endif>
                                    {{ $supplier->name }}</option>
                            @endforeach
                        </x-input-select>
                        <x-input-error :messages="$errors->get('supplier')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="category_id" :value="__('Category')" />
                        <x-input-select name="category_id" id="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($product->category_id === $category->id) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach
                        </x-input-select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="unit_id" :value="__('Unit')" />
                        <x-input-select name="unit_id" id="unit_id">
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" @if ($product->unit_id === $unit->id) selected @endif>
                                    {{ $unit->name }}</option>
                            @endforeach
                        </x-input-select>
                        <x-input-error :messages="$errors->get('unit')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form> --}}
            </div>
        </div>
    </div>
</x-app-layout>
