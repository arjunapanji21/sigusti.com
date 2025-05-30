<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - AutoWhatsApp.web.id</title>
    
    <!-- Primary Meta Tags -->
    <meta name="title" content="Terms of Service - AutoWhatsApp.web.id">
    <meta name="description" content="Terms of service and usage conditions for AutoWhatsApp.web.id automation tool.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white/80 nav-blur shadow-sm fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                        <h1 class="text-xl md:text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent">AutoWhatsApp.web.id</h1>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="mt-16 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-8">Terms of Service</h1>
                    
                    <div class="prose max-w-none">
                        <h2 class="text-xl font-semibold text-gray-900">1. Agreement to Terms</h2>
                        <p>By accessing or using autowhatsapp.web.id and Auto WhatsApp Web software ("the Service"), you agree to be bound by these Terms of Service. If you disagree with any part of the terms, you do not have permission to access the Service.</p>

                        <h2 class="text-xl font-semibold text-gray-900 mt-8">2. Intellectual Property</h2>
                        <p>Auto WhatsApp Web and all associated materials are the intellectual property of autowhatsapp.web.id. The software, code, proprietary methods, and systems are owned by us and are protected by copyright, trademark, and other intellectual property laws.</p>

                        <h2 class="text-xl font-semibold text-gray-900 mt-8">3. Use License & Restrictions</h2>
                        <p>We grant you a limited, non-exclusive, non-transferable license to:</p>
                        <ul class="list-disc pl-6 mt-4 space-y-2">
                            <li>Use the software for your personal or business communications</li>
                            <li>Access features according to your purchased plan</li>
                            <li>Integrate the software with your existing WhatsApp Web account</li>
                        </ul>

                        <p class="mt-4">You are expressly prohibited from:</p>
                        <ul class="list-disc pl-6 mt-4 space-y-2">
                            <li>Modifying, reverse engineering, or creating derivative works</li>
                            <li>Circumventing usage limits or monitoring systems</li>
                            <li>Reselling or redistributing the service</li>
                            <li>Using the service for any unlawful purposes</li>
                        </ul>

                        <h2 class="text-xl font-semibold text-gray-900 mt-8">4. Usage Policies</h2>
                        <p>All users must comply with:</p>
                        <ul class="list-disc pl-6 mt-4 space-y-2">
                            <li>Daily and monthly message limits as specified in their plan</li>
                            <li>WhatsApp's terms of service and policies</li>
                            <li>Local spam and electronic communication laws</li>
                            <li>Our anti-abuse and fair usage policies</li>
                        </ul>

                        <h2 class="text-xl font-semibold text-gray-900 mt-8">5. Service Modifications</h2>
                        <p>autowhatsapp.web.id reserves the right to:</p>
                        <ul class="list-disc pl-6 mt-4 space-y-2">
                            <li>Modify or discontinue any part of the service</li>
                            <li>Change pricing with reasonable notice</li>
                            <li>Limit service access for policy violations</li>
                            <li>Update these terms as needed</li>
                        </ul>

                        <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-600">Last updated: {{date('F d, Y')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center text-gray-400">
                <p>&copy; {{date('Y')}} autowhatsapp.web.id. All rights reserved.
                    <a href="{{ route('terms') }}" class="hover:text-white">Terms</a> ·
                    <a href="{{ route('privacy') }}" class="hover:text-white">Privacy</a>
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
