@props([
    'type' => 'text',
    'name', 
    'id' => null,
    'value' => '', 
    'label' => null,
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'autocomplete' => null,
    'helper' => null,
    'leadingIcon' => null,
    'trailingIcon' => null,
    'floatingLabel' => false,
    'variant' => 'default', // default, inline, floating
])

@php
    $id = $id ?? $name;
    $baseClasses = 'block w-full px-3 py-2 rounded-md border border-base-light/30 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50';
    $classes = $baseClasses;
    
    if ($disabled) $classes .= ' opacity-60 cursor-not-allowed';
    if ($leadingIcon) $classes .= ' pl-10';
    if ($trailingIcon) $classes .= ' pr-10';
    
    $floatingLabel = $floatingLabel || $variant === 'floating';
    $inlineLabel = $variant === 'inline';
    
    $hasError = $errors->has($name);
    if ($hasError) $classes .= ' border-red-500 focus:border-red-500 focus:ring-red-500';
@endphp

<div {{ $attributes->class(['mb-4' => !$inlineLabel, 'sm:flex sm:items-center' => $inlineLabel]) }}>
    @if($label && !$floatingLabel)
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
        
        <input 
            x-data
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $id }}" 
            value="{{ $value }}"
            placeholder="{{ $floatingLabel && $label ? ' ' : $placeholder }}"
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            {{ $attributes->except(['class', 'label', 'helper', 'variant'])->merge(['class' => $classes]) }}
        >
        
        @if($floatingLabel && $label)
            <label for="{{ $id }}" class="absolute text-sm {{ $hasError ? 'text-red-600' : 'text-base-light' }} duration-300 transform 
                {{ strlen($value) > 0 ? '-translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3' : '-translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-3' }}">
                {{ $label }}@if($required)<span class="text-red-500 ml-1">*</span>@endif
            </label>
        @endif
        
        @if($trailingIcon)
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                {!! $trailingIcon !!}
            </div>
        @endif
    </div>
    
    @if($helper && !$hasError)
        <p class="{{ $inlineLabel ? 'sm:ml-1/3 sm:pl-2' : '' }} mt-1 text-sm text-base-light">{{ $helper }}</p>
    @endif

    @error($name)
        <p class="{{ $inlineLabel ? 'sm:ml-1/3 sm:pl-2' : '' }} mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
