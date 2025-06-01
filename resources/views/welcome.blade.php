<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-base-dark">Welcome to Laravel Boilerplate!</h2>
                            <p class="mt-1 text-base">This is your new application's welcome page.</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Go to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Feature Overview -->
            <div id="features" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium leading-6 text-base-dark">Features Available</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-base-dark">Authentication</h3>
                                <p class="mt-1 text-sm text-base">Complete user authentication and registration system.</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-base-dark">Dashboard</h3>
                                <p class="mt-1 text-sm text-base">Modern and responsive dashboard interface.</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-base-dark">Tailwind CSS 4</h3>
                                <p class="mt-1 text-sm text-base">Modern utility-first CSS framework.</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-base-dark">Alpine.js</h3>
                                <p class="mt-1 text-sm text-base">Lightweight JavaScript framework for interactivity.</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-base-dark">Laravel 12 with Blade Frontend</h3>
                                <p class="mt-1 text-sm text-base">Latest version of Laravel framework.</p>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-base-dark">Customizable</h3>
                                <p class="mt-1 text-sm text-base">Easy to extend and customize for your needs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Get Started -->
            <div id="getting-started" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-medium leading-6 text-base-dark">Get Started</h3>
                </div>
                <div class="p-6">
                    <p class="text-base mb-4">Ready to begin? Log in to your account to access all features.</p>
                    <div class="flex space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-base-light/30 rounded-md shadow-sm text-sm font-medium text-base-dark bg-white hover:bg-background focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
