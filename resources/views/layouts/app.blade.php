<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ url(asset('favicon.ico')) }}">
    <title>{{ config('app.name', 'SI-GUSTI') }} - Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Select2 Styles */
        .select2-container--default .select2-selection--single {
            height: 38px;
            padding: 5px;
            border-color: rgba(156, 163, 175, 0.3);
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #22c55e;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border-color: rgba(156, 163, 175, 0.5);
        }
        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            outline: 2px solid rgba(34, 197, 94, 0.3);
            border-color: #22c55e;
        }
        .select2-dropdown {
            border-color: rgba(156, 163, 175, 0.3);
        }
        .select2-container--default .select2-results__group {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            color: #6b7280;
            padding: 6px 10px;
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
            background-color: #1f2937;
            color: #e2e8f0;
        }
        
        body.dark-mode .bg-white {
            background-color: #1f2937;
        }
        
        body.dark-mode .border-gray-200 {
            border-color: #374151;
        }
        
        body.dark-mode .bg-background {
            background-color: #111827;
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
</head>
<body class="font-sans antialiased bg-gray-50">
    <div x-data="{ profileOpen: false }" @keydown.escape="profileOpen = false">
        <div class="min-h-screen">
            <!-- Sidebar -->
            <aside class="fixed inset-y-0 left-0 w-64 bg-gradient-to-r from-green-500 to-green-600 text-white border-r border-white/20 z-30 hidden lg:block">
                <div class="flex flex-col h-full">
                    <!-- Logo -->
                    <div class="h-16 flex items-center justify-center border-b border-white/20 px-4">
                        <div class="block items-center">
                            <h3 class="font-semibold text-2xl text-white">SI-GUSTI</h3>
                            <p class="text-xs text-white/80">Sistem Informasi Growth Up Stimulation</p>
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

                        <x-nav-link href="{{ route('balita.index') }}" :active="request()->routeIs('balita.*')">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span>Balita</span>
                        </x-nav-link>

                        <x-nav-link href="{{ route('pemeriksaan.index') }}" :active="request()->routeIs('pemeriksaan.*')">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c0 .621-.504 1.125-1.125 1.125H18a2.25 2.25 0 01-2.25-2.25V10.5M8.25 8.25V6a2.25 2.25 0 012.25-2.25h1.5c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125H9a2.25 2.25 0 01-2.25-2.25z" />
                            </svg>
                            <span>Pemeriksaan</span>
                        </x-nav-link>

                        <x-nav-link href="#">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            <span>Materi</span>
                        </x-nav-link>

                        <x-nav-link href="#">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <span>Inbox</span>
                        </x-nav-link>

                        @if(auth()->user()->isAdmin())
                        <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <span>Pengguna</span>
                        </x-nav-link>
                        @endif

                        <x-nav-link href="{{ route('settings.index') }}" :active="request()->routeIs('settings.*')">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Pengaturan</span>
                        </x-nav-link>

                        <x-nav-link href="{{ route('documentation') }}" :active="request()->routeIs('documentation')">
                            <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span>Panduan</span>
                        </x-nav-link>
                    </nav>
                    
                    <!-- User -->
                    <div class="border-t border-white/20 p-4">
                        <div x-data="{ userMenuOpen: false }" class="relative">
                            <button @click="userMenuOpen = !userMenuOpen" 
                                    @click.away="userMenuOpen = false"
                                    class="flex items-center w-full group">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-white/20 flex items-center justify-center">
                                        <span class="text-white font-medium text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-white group-hover:text-white/90">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-white/70 group-hover:text-white/80">View options</p>
                                </div>
                                <svg class="ml-2 h-5 w-5 text-white/70 group-hover:text-white/90" viewBox="0 0 20 20" fill="currentColor">
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
                                    <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">
                                        Profile Settings
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">
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
            <div class="lg:hidden fixed top-0 left-0 right-0 bg-gradient-to-r from-green-500 to-green-600 border-b border-white/20 z-30">
                <div class="flex items-center justify-between h-16 px-4">
                    <div class="block items-center">
                        <h3 class="font-semibold text-2xl text-white">SI-GUSTI</h3>
                        <p class="text-xs text-white/80">Sistem Informasi Growth Up Stimulation</p>
                    </div>
                    
                    <!-- Profile dropdown -->
                    <div class="relative" x-data>
                        <button type="button" 
                                @click="profileOpen = !profileOpen" 
                                class="flex items-center text-white hover:text-white/90">
                            <div class="h-10 w-10 rounded-full bg-white/20 flex items-center justify-center">
                                <span class="text-white font-medium">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
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
                                <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">
                                    Profile
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-green-600">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <main class="min-h-screen lg:pl-64">
                <div class="py-20 lg:py-6 pb-24">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <!-- Alert notifications -->
                        <x-alerts />
                        
                        <!-- Main content -->
                        @yield('content')
                        {{ $slot ?? '' }}
                    </div>
                </div>
            </main>

            <!-- Bottom Navigation -->
            <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-gradient-to-r from-green-500 to-green-600 border-t border-white/20 px-2 py-1 z-40">
                <div class="flex justify-around">
                    <a href="{{ route('dashboard') }}" class="flex flex-col items-center py-1.5 px-2 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-white/70' }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13z"></path>
                        </svg>
                        <span class="text-xs mt-0.5 font-medium">Beranda</span>
                    </a>

                    <a href="#" class="flex flex-col items-center py-1.5 px-2 text-white/70">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-xs mt-0.5">Balita</span>
                    </a>

                    <a href="#" class="flex flex-col items-center py-1.5 px-2 text-white/70">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="text-xs mt-0.5">Grafik</span>
                    </a>

                    <a href="#" class="flex flex-col items-center py-1.5 px-2 text-white/70">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        <span class="text-xs mt-0.5">Imunisasi</span>
                    </a>

                    <a href="{{ url('/profile') }}" class="flex flex-col items-center py-1.5 px-2 {{ request()->routeIs('profile.*') ? 'text-white' : 'text-white/70' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-xs mt-0.5">Profil</span>
                    </a>
                </div>
            </div>
        
            @stack('scripts')
        </div>
    </div>
</body>
</html>
