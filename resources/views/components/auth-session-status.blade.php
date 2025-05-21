@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded relative']) }} role="alert">
        <span class="block sm:inline">{{ $status }}</span>
    </div>
@endif
