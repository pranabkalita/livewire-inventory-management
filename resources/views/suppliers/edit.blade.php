<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Suppliers
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="flex justify-start">
                    <a href="{{ route('suppliers.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</a>
                </div>

                <form method="post" action="{{ route('suppliers.update', $supplier->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            value="{{ old('name', $supplier->name) }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                            value="{{ old('email', $supplier->email) }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone_number" :value="__('Phone number')" />
                        <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full"
                            value="{{ old('phone_number', $supplier->phone_number) }}" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-textarea id="address" name="address" type="text" class="mt-1 block w-full">
                            {{ old('address', $supplier->address) }}
                        </x-text-textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            name="status" value="{{ $supplier->status }}}">
                            <option value="{{ \App\Models\Supplier::STATUS['ACTIVE'] }}"
                                @if ($supplier->status === \App\Models\Supplier::STATUS['ACTIVE']) selected @endif>Active</option>
                            <option value="{{ \App\Models\Supplier::STATUS['INACTIVE'] }}"
                                @if ($supplier->status === \App\Models\Supplier::STATUS['INACTIVE']) selected @endif>Inactive</option>
                        </select>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
