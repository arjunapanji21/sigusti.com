@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-gray-900 mb-4">404</h1>
        <p class="text-2xl text-gray-600 mb-8">Page Not Found</p>
        <p class="text-gray-500 mb-8 max-w-md mx-auto">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
        <div class="flex gap-4 justify-center">
            <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                Go Back
            </a>
            <a href="{{ route('landing') }}" class="inline-flex items-center px-4 py-2 border border-green-600 rounded-md text-sm font-medium text-green-600 bg-white hover:bg-green-50">
                Homepage
            </a>
        </div>
    </div>
</div>
@endsection
