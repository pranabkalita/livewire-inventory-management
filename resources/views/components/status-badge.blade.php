@props(['title', 'color' => 'green'])

<span
    class="bg-{{ $color }}-200 text-{{ $color }}-600 py-1 px-3 rounded-full text-xs">{{ $title }}</span>
