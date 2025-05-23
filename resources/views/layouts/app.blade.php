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

    <style>
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        .toast-enter { animation: slideIn 0.3s ease-out forwards; }
        .toast-exit { animation: slideOut 0.3s ease-out forwards; }
        #toast-container {
            pointer-events: none;
        }
        #toast-container > div {
            pointer-events: auto;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div id="toast-container" class="fixed top-4 right-4 z-[9999]"></div>
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
                        <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                            <x-icon name="users" class="mr-3 h-5 w-5"/>
                            <span>Users</span>
                        </x-nav-link>
                        <x-nav-link href="{{ route('plans.index') }}" :active="request()->routeIs('plans.*')">
                            <x-icon name="template" class="mr-3 h-5 w-5"/>
                            <span>Plans</span>
                        </x-nav-link>

                        <!-- License Management -->
                        @can('admin-actions')
                            <x-nav-link href="{{ route('licenses.index') }}" :active="request()->routeIs('licenses.*')">
                                <x-icon name="key" class="mr-3 h-5 w-5"/>
                                <span>Licenses</span>
                            </x-nav-link>
                        @else
                            <x-nav-link href="{{ route('licenses.index') }}" :active="request()->routeIs('licenses.*')">
                                <x-icon name="key" class="mr-3 h-5 w-5"/>
                                <span>My License</span>
                            </x-nav-link>
                        @endcan

                        <!-- Payment Management -->
                        @can('admin-actions')
                            <x-nav-link href="{{ route('payments.index') }}" :active="request()->routeIs('payments.*')">
                                <x-icon name="credit-card" class="mr-3 h-5 w-5"/>
                                <span>Payments</span>
                            </x-nav-link>
                        @else
                            <x-nav-link href="{{ route('payments.index') }}" :active="request()->routeIs('payments.*')">
                                <x-icon name="credit-card" class="mr-3 h-5 w-5"/>
                                <span>My Payments</span>
                            </x-nav-link>
                        @endcan

                        <x-nav-link href="{{ route('documentation') }}" :active="request()->routeIs('documentation')">
                            <x-icon name="book-open" class="mr-3 h-5 w-5"/>
                            <span>Documentation</span>
                        </x-nav-link>
                        <x-nav-link href="{{ route('support') }}" :active="request()->routeIs('support')">
                            <x-icon name="support" class="mr-3 h-5 w-5"/>
                            <span>Support</span>
                        </x-nav-link>
                    @else
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            <x-icon name="home" class="mr-3 h-5 w-5"/>
                            <span>Dashboard</span>
                        </x-nav-link>
                        
                        @can('admin-actions')
                            <x-nav-link href="{{ route('licenses.index') }}" :active="request()->routeIs('licenses.*')">
                                <x-icon name="key" class="mr-3 h-5 w-5"/>
                                <span>Licenses</span>
                            </x-nav-link>
                        @else
                            <x-nav-link href="{{ route('licenses.index') }}" :active="request()->routeIs('licenses.*')">
                                <x-icon name="key" class="mr-3 h-5 w-5"/>
                                <span>My License</span>
                            </x-nav-link>
                        @endcan

                        <!-- Payment Management -->
                        @can('admin-actions')
                            <x-nav-link href="{{ route('payments.index') }}" :active="request()->routeIs('payments.*')">
                                <x-icon name="credit-card" class="mr-3 h-5 w-5"/>
                                <span>Payments</span>
                            </x-nav-link>
                        @else
                            <x-nav-link href="{{ route('payments.index') }}" :active="request()->routeIs('payments.*')">
                                <x-icon name="credit-card" class="mr-3 h-5 w-5"/>
                                <span>My Payments</span>
                            </x-nav-link>
                        @endcan

                        <x-nav-link href="{{ route('documentation') }}" :active="request()->routeIs('documentation')">
                            <x-icon name="book-open" class="mr-3 h-5 w-5"/>
                            <span>Documentation</span>
                        </x-nav-link>
                        <x-nav-link href="{{ route('support') }}" :active="request()->routeIs('support')">
                            <x-icon name="support" class="mr-3 h-5 w-5"/>
                            <span>Support</span>
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
                    <x-alerts />
                    @if (session('success'))
                        <div x-data="{}" x-init="showToast('{{ session('success') }}', 'green')"></div>
                    @endif
                    @if (session('error'))
                        <div x-data="{}" x-init="showToast('{{ session('error') }}', 'red')"></div>
                    @endif
                    @if (session('warning'))
                        <div x-data="{}" x-init="showToast('{{ session('warning') }}', 'yellow')"></div>
                    @endif
                    @if (session('info'))
                        <div x-data="{}" x-init="showToast('{{ session('info') }}', 'blue')"></div>
                    @endif
                    @yield('content')
                    {{ $slot ?? '' }}
                </div>
            </div>
        </main>
        @stack('scripts')
        <script>
            window.toggleLicense = function(licenseId) {
                const container = document.getElementById(`license-${licenseId}`);
                if (!container) return;
                
                const textElement = container.querySelector('.license-text');
                const keyElement = container.querySelector('.license-key');
                
                if (textElement.classList.contains('hidden')) {
                    textElement.classList.remove('hidden');
                    keyElement.classList.add('hidden');
                } else {
                    textElement.classList.add('hidden');
                    keyElement.classList.remove('hidden');
                }
            }

            window.copyLicense = function(licenseId) {
                const container = document.getElementById(`license-${licenseId}`);
                if (!container) return;

                const licenseKey = container.querySelector('.license-key')?.textContent;
                if (!licenseKey) return;

                navigator.clipboard.writeText(licenseKey)
                    .then(() => {
                        const button = container.querySelector('button:last-child');
                        if (button) {
                            button.classList.remove('text-gray-400', 'hover:text-gray-600');
                            button.classList.add('text-green-500');
                            
                            setTimeout(() => {
                                button.classList.remove('text-green-500');
                                button.classList.add('text-gray-400', 'hover:text-gray-600');
                            }, 1000);
                        }
                        
                        showToast('License key copied to clipboard!');
                    })
                    .catch(() => {
                        showToast('Failed to copy license key', 'red');
                    });
            }

            function showToast(message, type = 'green') {
                const container = document.getElementById('toast-container');
                if (!container) return;

                const toast = document.createElement('div');
                toast.className = `toast-enter fixed top-4 right-4 z-[9999] bg-white border border-${type}-500 text-${type}-700 px-4 py-2 rounded-lg shadow-md`;
                toast.innerText = message;

                container.appendChild(toast);

                setTimeout(() => {
                    toast.classList.remove('toast-enter');
                    toast.classList.add('toast-exit');
                }, 3000);

                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 3300);
            }
        </script>
    </body>
</html>
