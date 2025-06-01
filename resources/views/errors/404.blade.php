<x-error-layout>
    <div class="text-center">
        <h1 class="text-9xl font-bold text-primary">404</h1>
        <h2 class="text-2xl font-semibold text-base-dark mt-4">Page Not Found</h2>
        <p class="text-base text-base-light mt-2">The page you are looking for doesn't exist or has been moved.</p>
        
        <div class="mt-8">
            <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Back to Home
            </a>
        </div>
    </div>
</x-error-layout>
