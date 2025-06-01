<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Updated Favicon Tags -->
    <link rel="icon" type="image/x-icon" href="{{ url(asset('favicon.ico')) }}">
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="{{ url(asset('favicon-32x32.png')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url(asset('favicon-16x16.png')) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url(asset('apple-touch-icon.png')) }}"> --}}
    <title>Laravel 12 Boilerplate | Modern Web Application Starter Kit</title>
    
    <!-- Primary Meta Tags -->
    <meta name="title" content="Laravel 12 Boilerplate | Modern Web Application Starter Kit">
    <meta name="description" content="A powerful, feature-rich starter template for Laravel 12 applications with authentication, responsive UI, and modern tooling.">
    <meta name="keywords" content="Laravel 12, boilerplate, starter kit, web application, PHP framework">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Laravel 12 Boilerplate">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Laravel 12 Boilerplate | Modern Web Application Starter Kit">
    <meta property="og:description" content="A powerful, feature-rich starter template for Laravel 12 applications with authentication, responsive UI, and modern tooling.">
    <meta property="og:image" content="{{ url(asset('meta.png')) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Laravel 12 Boilerplate | Modern Web Application Starter Kit">
    <meta property="twitter:description" content="A powerful, feature-rich starter template for Laravel 12 applications with authentication, responsive UI, and modern tooling.">
    <meta property="twitter:image" content="{{ url(asset('meta.png')) }}">

    <!-- Structured Data -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebApplication",
            "name": "Laravel 12 Boilerplate",
            "applicationCategory": "WebApplication",
            "operatingSystem": "All",
            "description": "A powerful, feature-rich starter template for Laravel 12 applications with authentication, responsive UI, and modern tooling."
        }
    </script>

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .nav-blur {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-background">
    <!-- Navigation -->
    <nav class="bg-white/80 nav-blur shadow-sm fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{route('landing')}}" class="flex items-center space-x-2">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                        <h1 class="text-xl md:text-xl font-bold text-primary">Laravel 12 Boilerplate</h1>
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="flex items-center lg:hidden">
                    <button type="button" onclick="toggleMenu()" class="inline-flex items-center justify-center p-2 rounded-md text-base hover:text-base-dark hover:bg-background transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <!-- Desktop menu -->
                <div class="hidden lg:flex lg:items-center lg:space-x-8">
                    <a href="#features" class="text-base hover:text-base-dark transition-colors duration-200 font-medium">Features</a>
                    <a href="#getting-started" class="text-base hover:text-base-dark transition-colors duration-200 font-medium">Getting Started</a>
                    <a href="#docs" class="text-base hover:text-base-dark transition-colors duration-200 font-medium">Documentation</a>
                    <a href="https://github.com/laravel/laravel" target="_blank" class="text-base hover:text-base-dark transition-colors duration-200 font-medium">GitHub</a>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-base hover:text-base-dark transition-colors duration-200 font-medium">Log in</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2 rounded-lg hover:opacity-90 transition-opacity duration-200 font-medium shadow-md hover:shadow-lg">Register</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden lg:hidden shadow-lg bg-white/80 backdrop-blur-md border-t">
            <div class="px-2 pt-2 pb-8 space-y-1">
                <a href="#features" class="block px-3 py-2 rounded-md text-base hover:text-base-dark hover:bg-background transition-colors duration-200">Features</a>
                <a href="#getting-started" class="block px-3 py-2 rounded-md text-base hover:text-base-dark hover:bg-background transition-colors duration-200">Getting Started</a>
                <a href="#docs" class="block px-3 py-2 rounded-md text-base hover:text-base-dark hover:bg-background transition-colors duration-200">Documentation</a>
                <a href="https://github.com/laravel/laravel" target="_blank" class="block px-3 py-2 rounded-md text-base hover:text-base-dark hover:bg-background transition-colors duration-200">GitHub</a>
                <div class="mt-4 px-3 space-y-2">
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 border border-primary text-primary rounded-lg hover:bg-primary/5 transition-colors duration-200">Sign In</a>
                    <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2 bg-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Add top margin to account for fixed header -->
    <div class="mt-16">
        
        @yield('content')
        {{ $slot ?? '' }}

        <!-- Footer -->
        <footer class="bg-background-dark">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="text-center text-base-light">
                    <p>&copy; {{date('Y')}} Laravel 12 Boilerplate. All rights reserved.</p>
                    <p class="mt-2">Built with <span class="text-primary">♥</span> using Laravel {{ app()->version() }} and Tailwind CSS 4</p>
                </div>
            </div>
        </footer>

        <!-- Add required scripts -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true,
                offset: 100,
            });

            // Enhanced scroll effect for navigation
            let lastScroll = 0;
            const nav = document.querySelector('nav');
            window.addEventListener('scroll', () => {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll <= 0) {
                    nav.classList.remove('shadow-md', 'py-2');
                    return;
                }
                if (currentScroll > lastScroll) {
                    // Scrolling down
                    nav.classList.add('-translate-y-full');
                } else {
                    // Scrolling up
                    nav.classList.remove('-translate-y-full');
                }
                lastScroll = currentScroll;
            });

            // Add scroll effect to navigation
            window.addEventListener('scroll', function() {
                const nav = document.querySelector('nav');
                if (window.scrollY > 0) {
                    nav.classList.add('shadow-md');
                } else {
                    nav.classList.remove('shadow-md');
                }
            });

            function toggleMenu() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            }

            // Close mobile menu when clicking menu items
            document.querySelectorAll('#mobile-menu a').forEach(link => {
                link.addEventListener('click', () => {
                    document.getElementById('mobile-menu').classList.add('hidden');
                });
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        </script>
    </body>
</html>
