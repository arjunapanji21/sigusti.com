@props([
    'name', 
    'id' => null,
    'value' => '', 
    'label' => null,
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'rows' => 3,
    'helper' => null,
    'leadingIcon' => null,
    'variant' => 'default', // default, inline
])

@php
    $id = $id ?? $name;
    $baseClasses = 'block w-full px-3 py-2 rounded-md border border-base-light/30 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50';
    $classes = $baseClasses;
    
    if ($disabled) $classes .= ' opacity-60 cursor-not-allowed';
    if ($leadingIcon) $classes .= ' pl-10';
    
    $inlineLabel = $variant == 'inline';
    
    $hasError = $errors->has($name);
    if ($hasError) $classes .= ' border-red-500 focus:border-red-500 focus:ring-red-500';
@endphp

<div {{ $attributes->class(['mb-4' => !$inlineLabel, 'sm:flex sm:items-center' => $inlineLabel]) }}>
    @if($label)
        <label for="{{ $id }}" class="{{ $inlineLabel ? 'sm:w-1/3 pr-2' : '' }} block text-sm font-medium {{ $hasError ? 'text-red-600' : 'text-base-dark' }} mb-1">
            {{ $label }}@if($required)<span class="text-red-500 ml-1">*</span>@endif
        </label>
    @endif
    
    <div class="{{ $inlineLabel ? 'sm:w-2/3 mt-1 sm:mt-0' : '' }} relative">
        @if($leadingIcon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                {!! $leadingIcon !!}
            </div>
        @endif
        
        <textarea 
            name="{{ $name }}" 
            id="{{ $id }}" 
            placeholder="{{ $placeholder }}"
            rows="{{ $rows }}"
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            {{ $attributes->except(['class', 'label', 'helper', 'variant'])->merge(['class' => $classes]) }}
        >{{ $value }}</textarea>
    </div>
    
    @if($helper && !$hasError)
        <p class="{{ $inlineLabel ? 'sm:ml-1/3 sm:pl-2' : '' }} mt-1 text-sm text-base-light">{{ $helper }}</p>
    @endif

    @error($name)
        <p class="{{ $inlineLabel ? 'sm:ml-1/3 sm:pl-2' : '' }} mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
