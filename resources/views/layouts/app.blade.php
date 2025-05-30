<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>{{ config('app.name', 'AutoWhatsApp.web.id') }} - Dashboard</title>
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

    <!-- Add Alpine.js CDN if not already included via vite -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased">
    <div x-data="{ mobileMenu: false, profileOpen: false }" @keydown.escape="mobileMenu = false; profileOpen = false">
        <div id="toast-container" class="fixed top-4 right-4 z-[9999]"></div>
        <div class="min-h-screen">
            <!-- Sidebar -->
            <aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 z-30 hidden lg:block">
                <div class="flex flex-col h-full">
                    <!-- Logo -->
                    <div class="h-16 flex items-center justify-center border-b border-gray-200 px-4">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                            <h3 class="font-semibold text-gray-800">AutoWhatsApp.Web.id</h3>
                        </div>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="flex-1 px-4 py-6 space-y-1">
                        @if(auth()->user()->is_admin)
                            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                <x-icon name="chart-pie" class="mr-3 h-5 w-5"/>
                                <span>Dashboard</span>
                            </x-nav-link>
                            <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                                <x-icon name="user-group" class="mr-3 h-5 w-5"/>
                                <span>Users</span>
                            </x-nav-link>
                            <x-nav-link href="{{ route('plans.index') }}" :active="request()->routeIs('plans.*')">
                                <x-icon name="receipt-percent" class="mr-3 h-5 w-5"/>
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
                                <x-icon name="document-text" class="mr-3 h-5 w-5"/>
                                <span>Documentation</span>
                            </x-nav-link>
                            <x-nav-link href="{{ route('support') }}" :active="request()->routeIs('support')">
                                <x-icon name="chat-bubble-left-right" class="mr-3 h-5 w-5"/>
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
                                <x-icon name="document-text" class="mr-3 h-5 w-5"/>
                                <span>Documentation</span>
                            </x-nav-link>
                            <x-nav-link href="{{ route('support') }}" :active="request()->routeIs('support')">
                                <x-icon name="chat-bubble-left-right" class="mr-3 h-5 w-5"/>
                                <span>Support</span>
                            </x-nav-link>
                        @endif
                    </nav>
                    
                    <!-- User -->
                    <div class="border-t border-gray-200 p-4">
                        <div x-data="{ userMenuOpen: false }" class="relative">
                            <button @click="userMenuOpen = !userMenuOpen" 
                                    @click.away="userMenuOpen = false"
                                    class="flex items-center w-full group">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-600 font-medium text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500 group-hover:text-gray-700">View options</p>
                                </div>
                                <svg class="ml-2 h-5 w-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="userMenuOpen"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute left-0 right-0 bottom-full mb-2 w-full bg-white border border-gray-200 rounded-md shadow-lg z-50">
                                <div class="py-1">
                                    <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Profile Settings
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Sign out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Mobile header -->
            <div class="lg:hidden fixed top-0 left-0 right-0 bg-white border-b border-gray-200 z-30">
                <div class="flex items-center justify-between h-16 px-4">
                    <button type="button" @click="mobileMenu = !mobileMenu" class="text-gray-500 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <!-- Profile with dropdown -->
                    <div class="relative" x-data>
                        <button type="button" 
                                @click="profileOpen = !profileOpen" 
                                class="flex items-center text-gray-500 hover:text-gray-600">
                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-600 font-medium text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            </div>
                        </button>
                        <div x-show="profileOpen"
                             @click.outside="profileOpen = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div x-show="mobileMenu" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-x-full"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform -translate-x-full"
                 class="fixed inset-0 z-40 lg:hidden" 
                 @click.away="mobileMenu = false"
                 x-cloak>
                <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                <div class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 z-50">
                    <!-- Add close button -->
                    <div class="flex items-center justify-between p-4">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                            <h3 class="text-sm font-semibold text-gray-800">AutoWhatsApp.Web.id</h3>
                        <button @click="mobileMenu = false" class="text-gray-500 hover:text-gray-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-col h-full">
                        <nav class="flex-1 px-4 py-6 space-y-1">
                            @if(auth()->user()->is_admin)
                                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                    <x-icon name="chart-pie" class="mr-3 h-5 w-5"/>
                                    <span>Dashboard</span>
                                </x-nav-link>
                                <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                                    <x-icon name="user-group" class="mr-3 h-5 w-5"/>
                                    <span>Users</span>
                                </x-nav-link>
                                <x-nav-link href="{{ route('plans.index') }}" :active="request()->routeIs('plans.*')">
                                    <x-icon name="receipt-percent" class="mr-3 h-5 w-5"/>
                                    <span>Plans</span>
                                </x-nav-link>
                                @can('admin-actions')
                                    <x-nav-link href="{{ route('licenses.index') }}" :active="request()->routeIs('licenses.*')">
                                        <x-icon name="key" class="mr-3 h-5 w-5"/>
                                        <span>Licenses</span>
                                    </x-nav-link>
                                    <x-nav-link href="{{ route('payments.index') }}" :active="request()->routeIs('payments.*')">
                                        <x-icon name="credit-card" class="mr-3 h-5 w-5"/>
                                        <span>Payments</span>
                                    </x-nav-link>
                                @else
                                    <x-nav-link href="{{ route('licenses.index') }}" :active="request()->routeIs('licenses.*')">
                                        <x-icon name="key" class="mr-3 h-5 w-5"/>
                                        <span>My License</span>
                                    </x-nav-link>
                                    <x-nav-link href="{{ route('payments.index') }}" :active="request()->routeIs('payments.*')">
                                        <x-icon name="credit-card" class="mr-3 h-5 w-5"/>
                                        <span>My Payments</span>
                                    </x-nav-link>
                                @endcan
                                <x-nav-link href="{{ route('documentation') }}" :active="request()->routeIs('documentation')">
                                    <x-icon name="document-text" class="mr-3 h-5 w-5"/>
                                    <span>Documentation</span>
                                </x-nav-link>
                                <x-nav-link href="{{ route('support') }}" :active="request()->routeIs('support')">
                                    <x-icon name="chat-bubble-left-right" class="mr-3 h-5 w-5"/>
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
                                    <x-nav-link href="{{ route('payments.index') }}" :active="request()->routeIs('payments.*')">
                                        <x-icon name="credit-card" class="mr-3 h-5 w-5"/>
                                        <span>Payments</span>
                                    </x-nav-link>
                                @else
                                    <x-nav-link href="{{ route('licenses.index') }}" :active="request()->routeIs('licenses.*')">
                                        <x-icon name="key" class="mr-3 h-5 w-5"/>
                                        <span>My License</span>
                                    </x-nav-link>
                                    <x-nav-link href="{{ route('payments.index') }}" :active="request()->routeIs('payments.*')">
                                        <x-icon name="credit-card" class="mr-3 h-5 w-5"/>
                                        <span>My Payments</span>
                                    </x-nav-link>
                                @endcan
                                <x-nav-link href="{{ route('documentation') }}" :active="request()->routeIs('documentation')">
                                    <x-icon name="document-text" class="mr-3 h-5 w-5"/>
                                    <span>Documentation</span>
                                </x-nav-link>
                                <x-nav-link href="{{ route('support') }}" :active="request()->routeIs('support')">
                                    <x-icon name="chat-bubble-left-right" class="mr-3 h-5 w-5"/>
                                    <span>Support</span>
                                </x-nav-link>
                            @endif
                        </nav>
                    </div>
                    <div class="border-t border-gray-200 p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-600 font-medium text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                </div>
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
            </div>

            <!-- Main content -->
            <main class="lg:pl-64">
                <div class="py-20 lg:py-6">
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

                    // Function to handle successful copy
                    const handleSuccess = () => {
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
                    };

                    // Function to handle copy failure
                    const handleError = () => {
                        showToast('Failed to copy license key', 'red');
                    };

                    // Try to use the clipboard API first
                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(licenseKey)
                            .then(handleSuccess)
                            .catch(() => {
                                // If clipboard API fails, try fallback
                                fallbackCopyToClipboard(licenseKey, handleSuccess, handleError);
                            });
                    } else {
                        // Use fallback for browsers without clipboard API
                        fallbackCopyToClipboard(licenseKey, handleSuccess, handleError);
                    }
                }

                function fallbackCopyToClipboard(text, onSuccess, onError) {
                    try {
                        // Create temporary textarea
                        const textArea = document.createElement('textarea');
                        textArea.value = text;
                        
                        // Make it invisible
                        textArea.style.position = 'fixed';
                        textArea.style.top = '0';
                        textArea.style.left = '0';
                        textArea.style.width = '2em';
                        textArea.style.height = '2em';
                        textArea.style.padding = '0';
                        textArea.style.border = 'none';
                        textArea.style.outline = 'none';
                        textArea.style.boxShadow = 'none';
                        textArea.style.background = 'transparent';
                        
                        document.body.appendChild(textArea);
                        textArea.focus();
                        textArea.select();
                        
                        const successful = document.execCommand('copy');
                        document.body.removeChild(textArea);
                        
                        if (successful) {
                            onSuccess();
                        } else {
                            onError();
                        }
                    } catch (err) {
                        onError();
                    }
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
        </div>
    </div>
</body>
</html>
