<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-gray-900">404</h1>
            <p class="mt-4 text-xl text-gray-600">Page not found</p>
            <p class="mt-2 text-gray-500">Sorry, we couldn't find the page you're looking for.</p>
            <div class="mt-6">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
