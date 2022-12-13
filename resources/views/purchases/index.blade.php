<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Purchases
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="flex justify-end">
                    <x-link-button href="{{ route('purchases.create') }}" title="Create New" />
                </div>

                <!-- component (https://tailwindcomponents.com/component/projects-table) -->
                <div class="bg-white shadow-md rounded my-6">
                    <x-table>
                        <x-table.thead>
                            <x-table.tr>
                                <x-table.th class="text-left">Id</x-table.th>
                                <x-table.th class="text-left">Purchase No.</x-table.th>
                                <x-table.th class="text-left">Product</x-table.th>
                                <x-table.th class="text-left">Supplier</x-table.th>
                                <x-table.th class="text-left">Category</x-table.th>
                                <x-table.th class="text-left">Quantity</x-table.th>
                                <x-table.th class="text-left">Date</x-table.th>
                                <x-table.th class="text-center">Status</x-table.th>
                                <x-table.th class="text-center">Actions</x-table.th>
                            </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @foreach ($purchases as $purchase)
                                <x-table.tr in-body="true" class="border-b border-gray-200 hover:bg-gray-100">
                                    <x-table.td class="text-left whitespace-nowrap">
                                        {{ $purchase->id }}
                                    </x-table.td>
                                    <x-table.td class="text-left whitespace-nowrap">
                                        {{ $purchase->purchase_number }}
                                    </x-table.td>
                                    <x-table.td class="text-left">
                                        {{ $purchase->product->name }}
                                    </x-table.td>
                                    <x-table.td class="text-center">
                                        {{ $purchase->supplier->email }}
                                    </x-table.td>
                                    <x-table.td class="text-center">
                                        {{ $purchase->category->name }}
                                    </x-table.td>
                                    <x-table.td class="text-center">
                                        {{ $purchase->quantity }}
                                    </x-table.td>
                                    <x-table.td class="text-center">
                                        {{ $purchase->date }}
                                    </x-table.td>
                                    <x-table.td class="text-center">
                                        @if ($purchase->status === \App\Models\Purchase::STATUS['APPROVED'])
                                            <x-status-badge title="Approved" color="green" />
                                        @elseif($purchase->status === \App\Models\Purchase::STATUS['PENDING'])
                                            <x-status-badge title="Pending" color="red" />
                                        @endif
                                    </x-table.td>
                                    <x-table.td class="text-center">
                                        <div class="flex item-center justify-center">
                                            @if ($purchase->status === \App\Models\Purchase::STATUS['PENDING'])
                                                <form action="{{ route('purchases.destroy', $purchase->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:underline ml-2"
                                                        onclick='return confirm("Are you sure ?")'>Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                    </x-table.td>
                                </x-table.tr>
                            @endforeach
                        </x-table.tbody>
                    </x-table>

                    <div class="mt-3 p-2">
                        {{ $purchases->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
