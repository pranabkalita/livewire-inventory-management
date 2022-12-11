<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Suppliers
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="flex justify-end">
                    <a href="{{ route('suppliers.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Create
                        New</a>
                </div>

                <!-- component (https://tailwindcomponents.com/component/projects-table) -->
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Id</th>
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-center">Email</th>
                                <th class="py-3 px-6 text-center">Phone</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($suppliers as $supplier)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        {{ $supplier->id }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $supplier->name }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        {{ $supplier->email }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        {{ $supplier->phone_number }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        @if ($supplier->status === \App\Models\Supplier::STATUS['ACTIVE'])
                                            <span
                                                class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Active</span>
                                        @elseif($supplier->status === \App\Models\Supplier::STATUS['INACTIVE'])
                                            <span
                                                class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                                class="text-indigo-500 hover:underline">
                                                Edit
                                            </a>

                                            <form action="{{ route('suppliers.destroy', $supplier->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline ml-2"
                                                    onclick='return confirm("Are you sure ?")'>Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3 p-2">
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
