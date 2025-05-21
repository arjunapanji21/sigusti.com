@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-gray-50 border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md p-2']) !!}>
