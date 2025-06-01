<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ url(asset('favicon.ico')) }}">
    <title>{{ config('app.name', 'Laravel 12 Boilerplate') }} - Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Select2 Styles */
        .select2-container--default .select2-selection--single {
            height: 38px;
            padding: 5px;
            border-color: rgba(var(--base-light-rgb), 0.3);
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: var(--primary-color);
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border-color: rgba(var(--base-light-rgb), 0.5);
        }
        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            outline: 2px solid rgba(var(--primary-rgb), 0.3);
            border-color: var(--primary-color);
        }
        .select2-dropdown {
            border-color: rgba(var(--base-light-rgb), 0.3);
        }
        .select2-container--default .select2-results__group {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            color: #6b7280;
            padding: 6px 10px;
        }

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

        /* Theme variables and customization */
        :root {
            --transition-speed: 0.2s;
        }
        
        body {
            transition: background-color var(--transition-speed) ease-in-out, color var(--transition-speed) ease-in-out;
        }
        
        /* Dark mode styles */
        body.dark-mode {
            background-color: var(--color-background-dark);
            color: #e2e8f0;
        }
        
        body.dark-mode .bg-white {
            background-color: #1f2937;
        }
        
        body.dark-mode .text-base-dark {
            color: #e2e8f0;
        }
        
        body.dark-mode .text-base {
            color: #cbd5e1;
        }
        
        body.dark-mode .text-base-light {
            color: #94a3b8;
        }
        
        body.dark-mode .border-gray-200 {
            border-color: #374151;
        }
        
        body.dark-mode .border-base-light\/30 {
            border-color: rgba(148, 163, 184, 0.3);
        }
        
        body.dark-mode .bg-background {
            background-color: #111827;
        }
        
        /* High contrast mode */
        body.high-contrast {
            --color-primary: #0000ff;
            --primary-color: #0000ff;
            --color-background: #ffffff;
            --background-color: #ffffff;
            --color-base: #000000;
            --base-color: #000000;
        }
        
        body.high-contrast.dark-mode {
            --color-primary: #ffff00;
            --primary-color: #ffff00;
            --color-background: #000000;
            --background-color: #000000;
            --color-base: #ffffff;
            --base-color: #ffffff;
        }
        
        /* Reduced motion */
        body.reduced-motion * {
            animation-duration: 0.001ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.001ms !important;
        }
        
        /* Sidebar collapsed */
        @media (min-width: 768px) {
            body.sidebar-collapsed .sidebar {
                width: 5rem;
            }
            
            body.sidebar-collapsed .sidebar span {
                display: none;
            }
            
            body.sidebar-collapsed .main-content {
                margin-left: 5rem;
            }
        }
    </style>

    <!-- Add Alpine.js CDN -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Theme initialization script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Apply saved theme settings on page load
            const savedSettings = localStorage.getItem('appThemeSettings');
            if (savedSettings) {
                const settings = JSON.parse(savedSettings);
                applyThemeFromSettings(settings);
            }
            
            // Function to apply theme from settings
            function applyThemeFromSettings(settings) {
                const root = document.documentElement;
                
                // Apply colors
                if (settings.colors) {
                    for (const [key, value] of Object.entries(settings.colors)) {
                        const rgb = hexToRgb(value);
                        if (rgb) {
                            root.style.setProperty(`--color-${key}`, value);
                            root.style.setProperty(`--${key}-color`, value);
                            root.style.setProperty(`--${key}-rgb`, `${rgb.r}, ${rgb.g}, ${rgb.b}`);
                        }
                    }
                }
                
                // Apply theme mode
                if (settings.mode) {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    const isDark = settings.mode === 'dark' || (settings.mode === 'system' && prefersDark);
                    
                    if (isDark) {
                        document.body.classList.add('dark-mode');
                        root.style.setProperty('--color-background', '#1a202c');
                        root.style.setProperty('--background-color', '#1a202c');
                    } else {
                        document.body.classList.remove('dark-mode');
                        root.style.setProperty('--color-background', '#f8fafc');
                        root.style.setProperty('--background-color', '#f8fafc');
                    }
                }
                
                // Apply options
                if (settings.options) {
                    // High contrast
                    if (settings.options.highContrast) {
                        document.body.classList.add('high-contrast');
                    } else {
                        document.body.classList.remove('high-contrast');
                    }
                    
                    // Reduced motion
                    if (settings.options.reducedMotion) {
                        document.body.classList.add('reduced-motion');
                    } else {
                        document.body.classList.remove('reduced-motion');
                    }
                    
                    // Animations
                    if (!settings.options.animations) {
                        root.style.setProperty('--transition-speed', '0s');
                    } else {
                        root.style.setProperty('--transition-speed', '0.2s');
                    }
                    
                    // Sidebar
                    if (settings.options.sidebarCollapsed) {
                        document.body.classList.add('sidebar-collapsed');
                    } else {
                        document.body.classList.remove('sidebar-collapsed');
                    }
                }
            }
            
            // Helper function to convert hex to RGB
            function hexToRgb(hex) {
                if (!hex) return null;
                
                const shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
                hex = hex.replace(shorthandRegex, (m, r, g, b) => r + r + g + g + b + b);
                
                const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                return result ? {
                    r: parseInt(result[1], 16),
                    g: parseInt(result[2], 16),
                    b: parseInt(result[3], 16)
                } : null;
            }
        });
    </script>
</head>
<body class="font-sans antialiased bg-background">
    <div x-data="{ mobileMenu: false, profileOpen: false }" @keydown.escape="mobileMenu = false; profileOpen = false">
        <div id="toast-container" class="fixed top-4 right-4 z-[9999]"></div>
        <div class="min-h-screen">
            <!-- Sidebar -->
            <aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-base-light/20 z-30 hidden lg:block">
                <div class="flex flex-col h-full">
                    <!-- Logo -->
                    <div class="h-16 flex items-center justify-center border-b border-base-light/20 px-4">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                            <h3 class="font-semibold text-primary">Laravel 12 Boilerplate</h3>
                        </div>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="flex-1 px-4 py-6 space-y-1">
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span>Dashboard</span>
                        </x-nav-link>

                        @if(auth()->user()->isAdmin())
                        <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <span>Users</span>
                        </x-nav-link>
                        @endif

                        <x-nav-link href="{{ route('profile.index') }}" :active="request()->routeIs('profile.*')">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Profile</span>
                        </x-nav-link>

                        <x-nav-link href="{{ route('settings.index') }}" :active="request()->routeIs('settings.*')">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Settings</span>
                        </x-nav-link>

                        <x-nav-link href="{{ route('documentation') }}" :active="request()->routeIs('documentation')">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span>Documentation</span>
                        </x-nav-link>
                    </nav>
                    
                    <!-- User -->
                    <div class="border-t border-base-light/20 p-4">
                        <div x-data="{ userMenuOpen: false }" class="relative">
                            <button @click="userMenuOpen = !userMenuOpen" 
                                    @click.away="userMenuOpen = false"
                                    class="flex items-center w-full group">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-primary/10 flex items-center justify-center">
                                        <span class="text-primary font-medium text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-base-dark group-hover:text-primary">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-base-light group-hover:text-base">View options</p>
                                </div>
                                <svg class="ml-2 h-5 w-5 text-base-light group-hover:text-base" viewBox="0 0 20 20" fill="currentColor">
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
                                 class="absolute left-0 right-0 bottom-full mb-2 w-full bg-white border border-base-light/20 rounded-md shadow-lg z-50">
                                <div class="py-1">
                                    <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-base hover:bg-background hover:text-primary">
                                        Profile Settings
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-base hover:bg-background hover:text-primary">
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
            <div class="lg:hidden fixed top-0 left-0 right-0 bg-white border-b border-base-light/20 z-30">
                <div class="flex items-center justify-between h-16 px-4">
                    <div class="flex items-center">
                        <button type="button" @click="mobileMenu = !mobileMenu" class="text-base hover:text-base-dark mr-2">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                    </div>
                    
                    <!-- Profile dropdown -->
                    <div class="relative" x-data>
                        <button type="button" 
                                @click="profileOpen = !profileOpen" 
                                class="flex items-center text-base hover:text-base-dark">
                            <div class="h-8 w-8 rounded-full bg-primary/10 flex items-center justify-center">
                                <span class="text-primary font-medium text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
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
                             class="absolute right-0 mt-2 w-48 bg-white border border-base-light/20 rounded-md shadow-lg z-50">
                            <div class="py-1">
                                <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-base hover:bg-background hover:text-primary">
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-base hover:bg-background hover:text-primary">
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
                <div class="absolute inset-0 bg-base-dark/50"></div>
                <div class="fixed inset-y-0 left-0 w-64 bg-white border-r border-base-light/20 z-50">
                    <!-- Mobile menu header -->
                    <div class="flex items-center justify-between p-4 border-b border-base-light/20">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                            <h3 class="text-sm font-semibold text-primary">Laravel 12 Boilerplate</h3>
                        </div>
                        <button @click="mobileMenu = false" class="text-base hover:text-base-dark">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Mobile menu content -->
                    <div class="flex flex-col h-full">
                        <nav class="flex-1 px-4 py-6 space-y-1">
                            <a href="{{ route('dashboard') }}" class="flex items-center px-2 py-2 text-base rounded-md {{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary' : 'text-base hover:bg-background hover:text-primary' }}">
                                <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <span>Dashboard</span>
                            </a>

                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.users.index') }}" class="flex items-center px-2 py-2 text-base rounded-md {{ request()->routeIs('admin.users.*') ? 'bg-primary/10 text-primary' : 'text-base hover:bg-background hover:text-primary' }}">
                                <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                                <span>Users</span>
                            </a>
                            @endif

                            <a href="{{ route('profile.index') }}" class="flex items-center px-2 py-2 text-base rounded-md {{ request()->routeIs('profile.*') ? 'bg-primary/10 text-primary' : 'text-base hover:bg-background hover:text-primary' }}">
                                <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Profile</span>
                            </a>

                            <a href="{{ route('settings.index') }}" class="flex items-center px-2 py-2 text-base rounded-md {{ request()->routeIs('settings.*') ? 'bg-primary/10 text-primary' : 'text-base hover:bg-background hover:text-primary' }}">
                                <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Settings</span>
                        </a>

                        <a href="{{ route('documentation') }}" class="flex items-center px-2 py-2 text-base rounded-md {{ request()->routeIs('documentation') ? 'bg-primary/10 text-primary' : 'text-base hover:bg-background hover:text-primary' }}">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span>Documentation</span>
                        </a>
                        </nav>
                    </div>
                    
                    <!-- Mobile menu footer -->
                    <div class="border-t border-base-light/20 p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-primary/10 flex items-center justify-center">
                                    <span class="text-primary font-medium text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-base-dark">{{ auth()->user()->name }}</p>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm text-base-light hover:text-primary">Sign out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <main class="min-h-screen lg:pl-64">
                <div class="py-20 lg:py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <!-- Alert notifications -->
                        <x-alerts />
                        @if (session('success'))
                            <div x-data="{}" x-init="showToast('{{ session('success') }}', 'primary')"></div>
                        @endif
                        @if (session('error'))
                            <div x-data="{}" x-init="showToast('{{ session('error') }}', 'primary')"></div>
                        @endif
                        @if (session('warning'))
                            <div x-data="{}" x-init="showToast('{{ session('warning') }}', 'accent')"></div>
                        @endif
                        @if (session('info'))
                            <div x-data="{}" x-init="showToast('{{ session('info') }}', 'secondary')"></div>
                        @endif
                        
                        <!-- Main content -->
                        @yield('content')
                        {{ $slot ?? '' }}
                    </div>
                </div>
            </main>
        
            @stack('scripts')
            <script>
                // Toast notification system
                function showToast(message, type = 'primary') {
                    const container = document.getElementById('toast-container');
                    if (!container) return;

                    const toast = document.createElement('div');
                    toast.className = `toast-enter fixed top-4 right-4 z-[9999] bg-white border border-${type} text-${type} px-4 py-2 rounded-lg shadow-md`;
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
