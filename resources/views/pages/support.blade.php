@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Quick Help Section -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900">Quick Help</h2>
                        <div class="mt-4 space-y-4">
                            {{-- <a href="#" class="flex items-center text-gray-700 hover:text-green-600">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                New User Guide
                            </a> --}}
                            <a href="{{ route('documentation') }}" class="flex items-center text-gray-700 hover:text-green-600">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                Documentation
                            </a>
                            <a href="#faq" class="flex items-center text-gray-700 hover:text-green-600">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                FAQs
                            </a>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
                        <div class="mt-4 space-y-3">
                            <p class="flex items-center text-sm text-gray-600">
                                <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                support@autowhatsapp.web.id
                            </p>
                            <p class="flex items-center text-sm text-gray-600">
                                <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                24/7 Support
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information & Manual -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Contact Us</h2>
                        <p class="mt-1 text-sm text-gray-600">We're here to help you 24/7</p>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        <!-- Contact Channels -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-gray-900">Email Support</h3>
                                    <p class="mt-1 text-sm text-gray-600">support@autowhatsapp.web.id</p>
                                    <p class="mt-1 text-xs text-gray-500">Response time: Within 24 hours</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-gray-900">WhatsApp Support</h3>
                                    <p class="mt-1 text-sm text-gray-600">+62 812-7131-0334</p>
                                    <p class="mt-1 text-xs text-gray-500">Available: 09.00 - 17.00 WIB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Start Guide -->
                        <div class="pt-6 border-t border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Start Guide</h3>
                            
                            <div class="space-y-4">
                                <div class="rounded-lg bg-gray-50 p-4">
                                    <h4 class="text-sm font-medium text-gray-900">1. Installation</h4>
                                    <ul class="mt-2 list-disc list-inside text-sm text-gray-600 space-y-1">
                                        <li>Download the latest version from your dashboard</li>
                                        <li>Run the installer and follow the setup wizard</li>
                                        <li>Enter your license key when prompted</li>
                                    </ul>
                                </div>

                                <div class="rounded-lg bg-gray-50 p-4">
                                    <h4 class="text-sm font-medium text-gray-900">2. Configuration</h4>
                                    <ul class="mt-2 list-disc list-inside text-sm text-gray-600 space-y-1">
                                        <li>Open WhatsApp Web on your browser</li>
                                        <li>Scan the QR code using your phone</li>
                                        <li>Configure auto-reply messages in the dashboard</li>
                                    </ul>
                                </div>

                                <div class="rounded-lg bg-gray-50 p-4">
                                    <h4 class="text-sm font-medium text-gray-900">3. Usage Tips</h4>
                                    <ul class="mt-2 list-disc list-inside text-sm text-gray-600 space-y-1">
                                        <li>Keep your WhatsApp Web session active</li>
                                        <li>Monitor response logs regularly</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div id="faq" class="mt-6 bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Frequently Asked Questions</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <details class="p-6 group">
                            <summary class="cursor-pointer list-none">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900">What are the system requirements?</h3>
                                    <span class="ml-6 flex-shrink-0 text-gray-400 group-open:rotate-180 transition-transform">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </span>
                                </div>
                            </summary>
                            <div class="mt-4 text-gray-600">
                                <ul class="list-disc pl-5 space-y-2">
                                    <li>Windows 10 or later</li>
                                    <li>4GB RAM minimum</li>
                                    <li>Stable internet connection</li>
                                    <li>Google Chrome or Microsoft Edge browser</li>
                                </ul>
                            </div>
                        </details>

                        <details class="p-6 group">
                            <summary class="cursor-pointer list-none">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-medium text-gray-900">How do I upgrade my plan?</h3>
                                    <span class="ml-6 flex-shrink-0 text-gray-400 group-open:rotate-180 transition-transform">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </span>
                                </div>
                            </summary>
                            <div class="mt-4 text-gray-600">
                                Visit the Plans section in your dashboard, select your desired plan, and follow the payment process. Your account will be upgraded immediately after payment confirmation.
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
