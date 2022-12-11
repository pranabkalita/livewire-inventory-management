@props([
    'inBody' => false,
])

@if ($inBody)
    <tr {{ $attributes }} class="border-b border-gray-200 hover:bg-gray-100">
        {{ $slot }}
    </tr>
@else
    <tr {{ $attributes->merge(['class' => 'bg-gray-200 text-gray-600 uppercase text-sm leading-normal']) }}>
        {{ $slot }}
    </tr>
@endif
