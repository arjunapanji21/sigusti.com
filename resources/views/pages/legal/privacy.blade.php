<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - AutoWhatsApp.web.id</title>
    
    <!-- Primary Meta Tags -->
    <meta name="title" content="Privacy Policy - AutoWhatsApp.web.id">
    <meta name="description" content="Privacy policy and data handling practices for AutoWhatsApp.web.id automation tool.">
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
                    <h1 class="text-3xl font-bold text-gray-900 mb-8">Privacy Policy</h1>
                    
                    <div class="prose max-w-none">
                        <h2 class="text-xl font-semibold text-gray-900">1. Information We Collect</h2>
                        <p>To provide and improve Auto WhatsApp Web services, we collect:</p>
                        <h3 class="text-lg font-medium text-gray-800 mt-4">1.1 Account Information</h3>
                        <ul class="list-disc pl-6 mt-2 space-y-2">
                            <li>Name and email address</li>
                            <li>Contact information</li>
                            <li>Business details (if applicable)</li>
                            <li>Login credentials</li>
                        </ul>

                        <h3 class="text-lg font-medium text-gray-800 mt-4">1.2 Usage Data</h3>
                        <ul class="list-disc pl-6 mt-2 space-y-2">
                            <li>Message statistics and patterns</li>
                            <li>Feature usage analytics</li>
                            <li>Performance metrics</li>
                            <li>Error logs and crash reports</li>
                        </ul>

                        <h2 class="text-xl font-semibold text-gray-900 mt-8">2. How We Use Your Information</h2>
                        <p>autowhatsapp.web.id uses collected data to:</p>
                        <ul class="list-disc pl-6 mt-4 space-y-2">
                            <li>Provide and maintain our services</li>
                            <li>Monitor and prevent abuse</li>
                            <li>Process payments and manage subscriptions</li>
                            <li>Improve our products and user experience</li>
                            <li>Communicate service updates</li>
                        </ul>

                        <h2 class="text-xl font-semibold text-gray-900 mt-8">3. Data Security</h2>
                        <p>We implement industry-standard security measures including:</p>
                        <ul class="list-disc pl-6 mt-4 space-y-2">
                            <li>End-to-end encryption for sensitive data</li>
                            <li>Regular security audits and updates</li>
                            <li>Secure data storage and transmission</li>
                            <li>Access controls and authentication</li>
                        </ul>

                        <h2 class="text-xl font-semibold text-gray-900 mt-8">4. Data Retention</h2>
                        <p>We retain your information only for as long as necessary to:</p>
                        <ul class="list-disc pl-6 mt-4 space-y-2">
                            <li>Provide our services to you</li>
                            <li>Comply with legal obligations</li>
                            <li>Resolve disputes</li>
                            <li>Enforce our agreements</li>
                        </ul>

                        <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-600">Last updated: {{date('F d, Y')}}</p>
                            <p class="text-sm text-gray-600 mt-2">Contact: privacy@autowhatsapp.web.id</p>
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
