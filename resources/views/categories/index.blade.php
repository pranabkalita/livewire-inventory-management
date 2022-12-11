<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="flex justify-end">
                    <x-link-button href="{{ route('categories.create') }}" title="Create New" />
                </div>

                <!-- component (https://tailwindcomponents.com/component/projects-table) -->
                <div class="bg-white shadow-md rounded my-6">
                    <x-table>
                        <x-table.thead>
                            <x-table.tr>
                                <x-table.th class="text-left">Id</x-table.th>
                                <x-table.th class="text-left">Name</x-table.th>
                                <x-table.th class="text-center">Status</x-table.th>
                                <x-table.th class="text-center">Actions</x-table.th>
                            </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @foreach ($categories as $category)
                                <x-table.tr in-body="true" class="border-b border-gray-200 hover:bg-gray-100">
                                    <x-table.td class="text-left whitespace-nowrap">
                                        {{ $category->id }}
                                    </x-table.td>
                                    <x-table.td class="text-left">
                                        {{ $category->name }}
                                    </x-table.td>
                                    <x-table.td class="text-center">
                                        @if ($category->status === \App\Models\Category::STATUS['ACTIVE'])
                                            <x-status-badge title="Active" color="green" />
                                        @elseif($category->status === \App\Models\Category::STATUS['INACTIVE'])
                                            <x-status-badge title="Inactive" color="red" />
                                        @endif
                                    </x-table.td>
                                    <x-table.td class="text-center">
                                        <div class="flex item-center justify-center">
                                            <x-link href="{{ route('categories.edit', $category->id) }}" title="Edit"
                                                color="indigo" />

                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline ml-2"
                                                    onclick='return confirm("Are you sure ?")'>Delete</button>
                                            </form>
                                        </div>
                                    </x-table.td>
                                </x-table.tr>
                            @endforeach
                        </x-table.tbody>
                    </x-table>

                    <div class="mt-3 p-2">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
