@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex items-center px-4 py-2 text-sm font-medium text-green-600 bg-green-50 rounded-md'
    : 'flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
