<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="flex justify-start">
                    <x-link-button href="{{ route('categories.index') }}" title=Back" />
                </div>

                <form method="post" action="{{ route('categories.update', $category->id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            value="{{ old('name', $category->name) }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <x-input-select name="status" id="status">
                            <option value="{{ \App\Models\Category::STATUS['ACTIVE'] }}"
                                @if ($category->status === \App\Models\Category::STATUS['ACTIVE']) selected @endif>Active</option>
                            <option value="{{ \App\Models\Category::STATUS['INACTIVE'] }}"
                                @if ($category->status === \App\Models\Category::STATUS['INACTIVE']) selected @endif>Inactive</option>
                        </x-input-select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
