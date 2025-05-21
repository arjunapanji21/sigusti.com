<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'WhatsApp Web Auto') }} - Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 z-30 hidden lg:block">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="h-16 flex items-center justify-center border-b border-gray-200">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-8 w-auto">
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-1">
                    @if(auth()->user()->is_admin)
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            <x-icon name="chart-bar" class="mr-3 h-5 w-5"/>
                            <span>Dashboard</span>
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                            <x-icon name="users" class="mr-3 h-5 w-5"/>
                            <span>Users</span>
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.activities.index') }}" :active="request()->routeIs('admin.activities.*')">
                            <x-icon name="clock" class="mr-3 h-5 w-5"/>
                            <span>Activities</span>
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.subscriptions.index') }}" :active="request()->routeIs('admin.subscriptions.*')">
                            <x-icon name="credit-card" class="mr-3 h-5 w-5"/>
                            <span>Subscriptions</span>
                        </x-nav-link>
                    @else
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            <x-icon name="home" class="mr-3 h-5 w-5"/>
                            <span>Dashboard</span>
                        </x-nav-link>
                        <x-nav-link href="{{ route('subscription') }}" :active="request()->routeIs('subscription')">
                            <x-icon name="credit-card" class="mr-3 h-5 w-5"/>
                            <span>Subscription</span>
                        </x-nav-link>
                    @endif
                </nav>
                
                <!-- User -->
                <div class="border-t border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile header -->
        <div class="lg:hidden fixed top-0 left-0 right-0 bg-white border-b border-gray-200 z-30">
            <div class="flex items-center justify-between h-16 px-4">
                <button type="button" @click="mobileMenu = true" class="text-gray-500 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-8 w-auto">
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="mobileMenu" class="fixed inset-0 z-40 lg:hidden" x-cloak>
            <!-- ... mobile menu content similar to sidebar ... -->
        </div>

        <!-- Main content -->
        <main class="lg:pl-64">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

    @stack('modals')
    @stack('scripts')
</body>
</html>
