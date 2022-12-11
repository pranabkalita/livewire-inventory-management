@props(['title', 'color' => 'indigo'])

<a {{ $attributes }} class="text-{{ $color }}-500 hover:underline">
    {{ $title }}
</a>
