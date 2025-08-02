@props(['active' => false])

@php
$classes = $active
    ? 'flex items-center px-2 py-2 text-sm font-medium rounded-md bg-white/20 text-white group'
    : 'flex items-center px-2 py-2 text-sm font-medium rounded-md text-white/80 hover:bg-white/10 hover:text-white group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
