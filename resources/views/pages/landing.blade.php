<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Web Auto - Automate Your WhatsApp Messaging | Best WhatsApp Automation Tool</title>
    
    <!-- Primary Meta Tags -->
    <meta name="title" content="WhatsApp Web Auto - Automate Your WhatsApp Messaging">
    <meta name="description" content="Automate your WhatsApp messages, schedule broadcasts, and streamline your messaging workflow with WhatsApp Web Auto. The most powerful WhatsApp automation tool for businesses.">
    <meta name="keywords" content="WhatsApp automation, WhatsApp Web Auto, message scheduling, automated responses, WhatsApp business tool">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="WhatsApp Web Auto">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="WhatsApp Web Auto - Automate Your WhatsApp Messaging">
    <meta property="og:description" content="Automate your WhatsApp messages, schedule broadcasts, and streamline your messaging workflow with WhatsApp Web Auto.">
    <meta property="og:image" content="{{ asset('images/wawa-social-preview.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="WhatsApp Web Auto - Automate Your WhatsApp Messaging">
    <meta property="twitter:description" content="Automate your WhatsApp messages, schedule broadcasts, and streamline your messaging workflow with WhatsApp Web Auto.">
    <meta property="twitter:image" content="{{ asset('images/wawa-social-preview.jpg') }}">

    <!-- Structured Data -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "SoftwareApplication",
            "name": "WhatsApp Web Auto",
            "applicationCategory": "BusinessApplication",
            "operatingSystem": "Windows",
            "offers": {
                "@type": "Offer",
                "price": "9.00",
                "priceCurrency": "USD"
            },
            "description": "WhatsApp Web Auto is a powerful desktop application designed to enhance your WhatsApp Web experience. Our tool helps businesses and individuals automate their messaging workflow.",
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
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-8 w-auto">
                        <h1 class="text-xl md:text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent">WhatsApp Web Auto</h1>
                    </div>
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
        <div id="mobile-menu" class="hidden lg:hidden bg-white/80 backdrop-blur-md border-t">
            <div class="px-2 pt-2 pb-3 space-y-1">
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
        <!-- Hero Section -->
        <div class="relative overflow-hidden py-16 md:py-24 bg-gradient-to-r from-green-500 to-green-600">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,...');"></div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center" data-aos="fade-up">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight">
                        Automate Your <span class="text-green-100">WhatsApp</span> Experience
                    </h2>
                    <p class="mt-6 text-xl md:text-2xl text-white opacity-90 max-w-3xl mx-auto">
                        Streamline your messaging workflow with powerful automation tools
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{route('register')}}" class="inline-flex items-center px-8 py-4 rounded-lg text-green-600 bg-white hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span class="text-lg font-semibold">Get Started Free</span>
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="#about" class="inline-flex items-center px-8 py-4 rounded-lg text-white border-2 border-white hover:bg-white/10 transition-all duration-300">
                            <span class="text-lg font-semibold">Learn More</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div id="about" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900">
                            About WhatsApp Web Auto
                        </h2>
                        <p class="mt-4 text-lg text-gray-600">
                            WhatsApp Web Auto is a powerful desktop application designed to enhance your WhatsApp Web experience. Our tool helps businesses and individuals automate their messaging workflow, save time, and improve communication efficiency.
                        </p>
                        <div class="mt-8">
                            <ul class="space-y-4">
                                <li class="flex items-center">
                                    <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="ml-3 text-gray-600">User-friendly interface</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="ml-3 text-gray-600">Secure and reliable</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="ml-3 text-gray-600">Regular updates and support</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-10 lg:mt-0">
                        <img class="rounded-lg shadow-xl" src="https://placehold.co/600x400" alt="WhatsApp Web Auto Interface">
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center" data-aos="fade-up">
                    <h2 class="text-3xl md:text-4xl font-extrabold gradient-text">
                        Powerful Features
                    </h2>
                    <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                        Everything you need to automate and streamline your WhatsApp messaging
                    </p>
                </div>
                
                <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div class="bg-white p-8 rounded-xl shadow-md card-hover" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-green-600 mb-4">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Automated Responses</h3>
                        <p class="mt-2 text-gray-600">Set up automatic replies for common messages and save time.</p>
                    </div>
                    <!-- Feature 2 -->
                    <div class="bg-white p-8 rounded-xl shadow-md card-hover" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-green-600 mb-4">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Message Scheduling</h3>
                        <p class="mt-2 text-gray-600">Schedule messages to be sent at specific times and dates.</p>
                    </div>
                    <!-- Feature 3 -->
                    <div class="bg-white p-8 rounded-xl shadow-md card-hover" data-aos="fade-up" data-aos-delay="300">
                        <div class="text-green-600 mb-4">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">Analytics</h3>
                        <p class="mt-2 text-gray-600">Track message statistics and engagement metrics.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing Section -->
        <div id="pricing" class="py-12 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900">Simple, Transparent Pricing</h2>
                    <p class="mt-4 text-lg text-gray-600">Choose the plan that best fits your needs</p>
                    
                    <!-- Billing Toggle -->
                    <div x-data="{ yearly: false }" @toggle-pricing.window="yearly = !yearly">
                        <div class="mt-8 flex justify-center items-center gap-4">
                            <span :class="!yearly ? 'text-gray-900 font-semibold' : 'text-gray-500'">Monthly</span>
                            <button type="button" 
                                    @click="$dispatch('toggle-pricing')"
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                                    :class="yearly ? 'bg-green-600' : 'bg-gray-200'">
                                <span class="translate-x-0 pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                      :class="yearly ? 'translate-x-5' : 'translate-x-0'"></span>
                            </button>
                            <span :class="yearly ? 'text-gray-900 font-semibold' : 'text-gray-500'">
                                Yearly
                                <span class="ml-1.5 inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">Save 20% more</span>
                            </span>
                        </div>

                        <div class="mt-12 flex flex-col lg:flex-row gap-8 justify-center items-center">
                            @foreach($plans as $plan)
                                <div class="bg-white w-full lg:w-1/3 rounded-lg shadow-lg overflow-hidden relative {{ $loop->iteration === 2 ? 'border-2 border-green-500' : '' }}">
                                    @if($loop->iteration === 2 && $plan->isOnSale())
                                        <div class="absolute animate-pulse -top-5 left-0 right-0 flex justify-center">
                                            <span class="pt-5 inline-flex h-11 items-center px-4 rounded-full text-sm font-semibold bg-red-500 text-white shadow-sm">
                                                Limited Time Offer!
                                            </span>
                                        </div>
                                    @endif

                                    <div class="px-6 py-8">
                                        <h3 class="text-2xl font-semibold text-gray-900">{{ $plan->name }}</h3>
                                        <p class="mt-4 text-gray-600">{{ $plan->description ?? 'Perfect for ' . strtolower($plan->name) . ' users' }}</p>
                                        
                                        <div class="mt-8 space-y-4">
                                            <div class="transition-all duration-300 transform">
                                                <div x-show="!yearly" x-transition:enter="transition ease-out duration-300"
                                                     x-transition:enter-start="opacity-0 -translate-y-2"
                                                     x-transition:enter-end="opacity-100 translate-y-0">
                                                    <span class="text-4xl font-extrabold text-gray-900">{{ $plan->monthly_price_formatted }}</span>
                                                    <span class="text-xl text-gray-500">/month</span>
                                                    @if($plan->isOnSale())
                                                        <div class="mt-2">
                                                            <span class="text-lg text-gray-500 line-through">{{ $plan->original_price_formatted }}</span>
                                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                {{ $plan->discount_badge }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div x-show="yearly" x-transition:enter="transition ease-out duration-300"
                                                     x-transition:enter-start="opacity-0 translate-y-2"
                                                     x-transition:enter-end="opacity-100 translate-y-0">
                                                    <span class="text-4xl font-extrabold text-gray-900">{{ $plan->yearly_price_formatted }}</span>
                                                    <span class="text-xl text-gray-500">/year</span>
                                                    <div class="mt-2">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Save Rp.{{ number_format(($plan->monthly_price * 12) - $plan->yearly_price) }} yearly
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <ul class="mt-8 space-y-4">
                                            <li class="flex items-center">
                                                <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="ml-3">Up to {{ number_format($plan->daily_limit) }} messages/day</span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="ml-3">Up to {{ number_format($plan->monthly_limit) }} messages/month</span>
                                            </li>
                                            <li class="flex items-center">
                                                <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                @if($plan->max_device > 1)
                                                    <span class="ml-3">Up to {{ $plan->max_device }} devices</span>
                                                @else
                                                    <span class="ml-3">Only 1 device</span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="px-6 py-4">
                                        <a href="{{ route('register') }}" 
                                           class="block w-full text-center px-4 py-2 {{ $loop->iteration === 2 ? 'bg-green-600 text-white hover:bg-green-700' : 'border border-green-600 text-green-600 hover:bg-green-50' }} rounded-md">
                                            Get Started
                                        </a>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Testimonials Section -->
                <div id="testimonials" class="bg-gray-100 py-12 md:py-16">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center">
                            <h2 class="text-3xl font-extrabold text-gray-900">
                                What Our Users Say
                            </h2>
                            <p class="mt-4 text-lg text-gray-600">
                                See how WhatsApp Web Auto has transformed the messaging experience for our users
                            </p>
                        </div>

                        <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                            <!-- Testimonial 1 -->
                            <div class="bg-white p-6 rounded-lg shadow">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 rounded-full bg-green-500 flex items-center justify-center text-white mr-4">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">John Doe</h4>
                                        <p class="text-gray-500">Business Owner</p>
                                    </div>
                                </div>
                                <p class="mt-4 text-gray-600">"This tool has saved me hours of repetitive work. Highly recommended!"</p>
                            </div>
                            <!-- Testimonial 2 -->
                            <div class="bg-white p-6 rounded-lg shadow">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 rounded-full bg-green-500 flex items-center justify-center text-white mr-4">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Jane Smith</h4>
                                        <p class="text-gray-500">Marketing Manager</p>
                                    </div>
                                </div>
                                <p class="mt-4 text-gray-600">"The automation features are incredible. Perfect for my business needs."</p>
                            </div>
                            <!-- Testimonial 3 -->
                            <div class="bg-white p-6 rounded-lg shadow">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 rounded-full bg-green-500 flex items-center justify-center text-white mr-4">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Mike Johnson</h4>
                                        <p class="text-gray-500">Freelancer</p>
                                    </div>
                                </div>
                                <p class="mt-4 text-gray-600">"Easy to use and very reliable. Customer support is excellent!"</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Download Section -->
                <div id="download" class="py-16">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl font-extrabold text-gray-900">
                            Ready to Get Started?
                        </h2>
                        <p class="mt-4 text-lg text-gray-600">
                            Download WhatsApp Web Auto now and transform your messaging experience
                        </p>
                        <div class="mt-8">
                            <a href="#" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                Download for Windows
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="bg-gray-800">
                    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                        <div class="text-center text-gray-400">
                            <p>&copy; 2023 WhatsApp Web Auto. All rights reserved.</p>
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
            </div>

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
