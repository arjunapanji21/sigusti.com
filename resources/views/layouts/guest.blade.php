<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Updated Favicon Tags -->
    <link rel="icon" type="image/x-icon" href="{{ url(asset('favicon.ico')) }}">
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="{{ url(asset('favicon-32x32.png')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url(asset('favicon-16x16.png')) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url(asset('apple-touch-icon.png')) }}"> --}}
    <title>AutoWhatsApp.web.id - Automate Your WhatsApp Messaging | Best WhatsApp Automation Tool</title>
    
    <!-- Primary Meta Tags -->
    <meta name="title" content="AutoWhatsApp.web.id - Automate Your WhatsApp Messaging">
    <meta name="description" content="Automate your WhatsApp messages, schedule broadcasts, and streamline your messaging workflow with AutoWhatsApp.web.id. The most powerful WhatsApp automation tool for businesses.">
    <meta name="keywords" content="WhatsApp automation, AutoWhatsApp.web.id, message scheduling, automated responses, WhatsApp business tool">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="AutoWhatsApp.web.id">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="AutoWhatsApp.web.id - Automate Your WhatsApp Messaging">
    <meta property="og:description" content="Automate your WhatsApp messages, schedule broadcasts, and streamline your messaging workflow with AutoWhatsApp.web.id.">
    <meta property="og:image" content="{{ url(asset('meta.png')) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="AutoWhatsApp.web.id - Automate Your WhatsApp Messaging">
    <meta property="twitter:description" content="Automate your WhatsApp messages, schedule broadcasts, and streamline your messaging workflow with AutoWhatsApp.web.id.">
    <meta property="twitter:image" content="{{ url(asset('meta.png')) }}">

    <!-- Structured Data -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "SoftwareApplication",
            "name": "AutoWhatsApp.web.id",
            "applicationCategory": "BusinessApplication",
            "operatingSystem": "Windows",
            "offers": {
                "@type": "Offer",
                "price": "69300",
                "priceCurrency": "IDR"
            },
            "description": "AutoWhatsApp.web.id is a powerful desktop application designed to enhance your WhatsApp Web experience. Our tool helps businesses and individuals automate their messaging workflow.",
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "4.8",
                "ratingCount": "1247"
            }
        }
    </script>

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .gradient-text {
            @apply bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-emerald-500;
        }
        
        .hover-scale {
            @apply transition-transform duration-300 hover:scale-105;
        }
        
        .card-hover {
            @apply transition-all duration-300 hover:shadow-lg hover:-translate-y-1;
        }
        
        .nav-blur {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white/80 nav-blur shadow-sm fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{route('landing')}}" class="flex items-center space-x-2">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                        <h1 class="text-xl md:text-xl font-bold bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent">AutoWhatsApp.web.id</h1>
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="flex items-center lg:hidden">
                    <button type="button" onclick="toggleMenu()" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <!-- Desktop menu -->
                <div class="hidden lg:flex lg:items-center lg:space-x-8">
                    <a href="#about" class="text-gray-600 hover:text-gray-900 transition-colors duration-200 font-medium">About</a>
                    <a href="#features" class="text-gray-600 hover:text-gray-900 transition-colors duration-200 font-medium">Features</a>
                    <a href="#pricing" class="text-gray-600 hover:text-gray-900 transition-colors duration-200 font-medium">Pricing</a>
                    <a href="#testimonials" class="text-gray-600 hover:text-gray-900 transition-colors duration-200 font-medium">Testimonials</a>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 transition-colors duration-200 font-medium">Sign In</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-green-600 to-emerald-500 text-white px-6 py-2 rounded-lg hover:opacity-90 transition-opacity duration-200 font-medium shadow-md hover:shadow-lg">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden lg:hidden shadow-lg bg-white/80 backdrop-blur-md border-t">
            <div class="px-2 pt-2 pb-8 space-y-1">
                <a href="#about" class="block px-3 py-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200">About</a>
                <a href="#features" class="block px-3 py-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200">Features</a>
                <a href="#pricing" class="block px-3 py-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200">Pricing</a>
                <a href="#testimonials" class="block px-3 py-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200">Testimonials</a>
                <div class="mt-4 px-3 space-y-2">
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-50 transition-colors duration-200">Sign In</a>
                    <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-500 text-white rounded-lg hover:opacity-90 transition-opacity duration-200">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Add top margin to account for fixed header -->
    <div class="mt-16">
        
        @yield('content')
        {{ $slot ?? '' }}

        <!-- Footer -->
        <footer class="bg-gray-800">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="text-center text-gray-400">
                    <p>&copy; {{date('Y')}} autowhatsapp.web.id. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Floating WhatsApp Button -->
        <a href="https://wa.me/6281271310334?text=Halo,%20saya%20ingin%20bertanya%20tentang%20WhatsApp%20Web%20Auto" 
           target="_blank"
           class="fixed bottom-4 md:bottom-8 right-4 md:right-8 bg-green-500 text-white p-3 md:p-4 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 hover:scale-110 z-50 flex items-center justify-center">
            <svg class="w-6 h-6 md:w-8 md:h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
            </svg>
        </a>

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
