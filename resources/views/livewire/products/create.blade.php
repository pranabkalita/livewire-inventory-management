<div>
    <form class="mt-6 space-y-6" wire:submit.prevent="save">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" class="mt-1 block w-full" wire:model="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="supplier_id" :value="__('Supplier')" />
            <x-input-select name="supplier_id" id="supplier_id" wire:model="supplier_id">
                <option value="">Select</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </x-input-select>
            <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
        </div>

        @if (!empty($categories))
            <div>
                <x-input-label for="category_id" :value="__('Category')" />
                <x-input-select name="category_id" id="category_id" wire:model="category_id">
                    <option value="">Select</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-input-select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>
        @endif

        <div>
            <x-input-label for="unit_id" :value="__('Unit')" />
            <x-input-select name="unit_id" id="unit_id" wire:model="unit_id">
                <option value="">Select</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
            </x-input-select>
            <x-input-error :messages="$errors->get('unit_id')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>
