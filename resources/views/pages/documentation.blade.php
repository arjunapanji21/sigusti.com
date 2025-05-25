@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Search Bar -->
    <div class="mb-6 px-4 sm:px-0">
        <div class="relative">
            <input type="text" id="docsSearch" 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                placeholder="Search documentation...">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="px-4 py-6 sm:px-0">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Sidebar Navigation - Move to top on mobile -->
            <div class="w-full lg:w-64 lg:flex-shrink-0 order-2 lg:order-1">
                <div class="bg-white rounded-lg shadow p-4 sticky top-6">
                    <nav class="space-y-1">
                        <a href="#getting-started" class="flex items-center px-3 py-2 text-sm font-medium text-blue-600 rounded-md bg-blue-50">
                            Getting Started
                        </a>
                        <a href="#license-management" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                            License Management
                        </a>
                        <a href="#usage-limits" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                            Usage Limits
                        </a>
                        <a href="#troubleshooting" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                            Troubleshooting
                        </a>
                        <a href="#installation" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                            Installation Guide
                        </a>
                        <a href="#user-manual" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-md">
                            User Manual
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 order-1 lg:order-2">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="prose max-w-none">
                        <section id="getting-started">
                            <h1 class="text-3xl font-bold text-gray-900">Documentation</h1>
                            <div class="mt-2 text-sm text-gray-500">Last updated: {{ now()->format('F d, Y') }}</div>
                            
                            <h2 class="mt-8 text-2xl font-semibold text-gray-900">Getting Started</h2>
                            <p class="mt-4 text-gray-600">Welcome to our WhatsApp Web Auto service documentation. This guide will help you understand how to use and integrate our service effectively.</p>
                            
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="font-medium text-gray-900">Prerequisites</h3>
                                    <ul class="mt-2 list-disc list-inside text-gray-600">
                                        <li>Active license key</li>
                                        <li>Windows 10 or later</li>
                                        <li>Stable internet connection</li>
                                        <li>WhatsApp Web access</li>
                                    </ul>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="font-medium text-gray-900">Quick Links</h3>
                                    <ul class="mt-2 space-y-2 text-gray-600">
                                        <li>
                                            <a href="#" class="flex items-center text-blue-600 hover:text-blue-800">
                                                <span>Download Software</span>
                                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#api-integration" class="text-blue-600 hover:text-blue-800">API Documentation</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>

                        <section id="license-management" class="mt-12">
                            <h2 class="text-2xl font-semibold text-gray-900">License Management</h2>
                            <div class="mt-6 space-y-6">
                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700">
                                                Keep your license key secure and do not share it with others. Each license is tied to specific usage limits.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add more license management content -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <h3 class="font-medium text-gray-900">Activating License</h3>
                                        <ol class="mt-2 list-decimal list-inside space-y-2 text-gray-600">
                                            <li>Go to License Management in your dashboard</li>
                                            <li>Click "Activate License" button</li>
                                            <li>Enter your license key</li>
                                            <li>System will verify and activate your license</li>
                                        </ol>
                                    </div>
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <h3 class="font-medium text-gray-900">License Status</h3>
                                        <div class="mt-2 space-y-2 text-gray-600">
                                            <p>Your license can have the following statuses:</p>
                                            <ul class="list-disc list-inside space-y-1">
                                                <li>Active: License is valid and working</li>
                                                <li>Inactive: License has been deactivated</li>
                                                <li>Expired: License period has ended</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section id="usage-limits" class="mt-12">
                            <h2 class="text-2xl font-semibold text-gray-900">Usage Limits</h2>
                            <div class="mt-6 space-y-6">
                                <p class="text-gray-600">Each license comes with specific usage limits based on your plan:</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <h3 class="font-medium text-gray-900">Daily Limits</h3>
                                        <div class="mt-4 space-y-2 text-gray-600">
                                            <div class="flex justify-between">
                                                <span>Messages sent today:</span>
                                                <span class="font-mono">daily_usage/daily_limit</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-blue-600 h-2 rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <h3 class="font-medium text-gray-900">Monthly Limits</h3>
                                        <div class="mt-4 space-y-2 text-gray-600">
                                            <div class="flex justify-between">
                                                <span>Messages this month:</span>
                                                <span class="font-mono">monthly_usage/monthly_limit</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-blue-600 h-2 rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section id="troubleshooting" class="mt-12">
                            <h2 class="text-2xl font-semibold text-gray-900">Troubleshooting</h2>
                            <div class="mt-6 space-y-6">
                                <div class="divide-y divide-gray-200">
                                    <div class="py-4">
                                        <details class="group">
                                            <summary class="flex items-center justify-between cursor-pointer">
                                                <h3 class="text-lg font-medium text-gray-900">License Not Working</h3>
                                                <span class="ml-6 flex-shrink-0">
                                                    <svg class="h-5 w-5 text-gray-400 group-open:hidden" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/>
                                                    </svg>
                                                    <svg class="h-5 w-5 text-gray-400 hidden group-open:block" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"/>
                                                    </svg>
                                                </span>
                                            </summary>
                                            <div class="mt-4 text-gray-600">
                                                <ol class="list-decimal list-inside space-y-2">
                                                    <li>Verify your license key is entered correctly</li>
                                                    <li>Check if your license is still active</li>
                                                    <li>Ensure you haven't exceeded usage limits</li>
                                                    <li>Try deactivating and reactivating the license</li>
                                                </ol>
                                            </div>
                                        </details>
                                    </div>

                                    <div class="py-4">
                                        <details class="group">
                                            <summary class="flex items-center justify-between cursor-pointer">
                                                <h3 class="text-lg font-medium text-gray-900">Usage Limits Exceeded</h3>
                                                <span class="ml-6 flex-shrink-0">
                                                    <svg class="h-5 w-5 text-gray-400 group-open:hidden" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"/>
                                                    </svg>
                                                    <svg class="h-5 w-5 text-gray-400 hidden group-open:block" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"/>
                                                    </svg>
                                                </span>
                                            </summary>
                                            <div class="mt-4 text-gray-600">
                                                <p>If you've exceeded your usage limits:</p>
                                                <ul class="mt-2 list-disc list-inside space-y-2">
                                                    <li>Daily limits reset at midnight GMT+7</li>
                                                    <li>Monthly limits reset on the 1st of each month</li>
                                                    <li>Consider upgrading your plan for higher limits</li>
                                                </ul>
                                            </div>
                                        </details>
                                    </div>
                                </div>

                                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <h3 class="text-lg font-medium text-green-800">Need Help?</h3>
                                    <p class="mt-2 text-sm text-green-700">
                                        Our support team is available 24/7 to help you with any issues.
                                        <a href="{{ route('support') }}" class="font-medium underline">Contact Support</a>
                                    </p>
                                </div>
                            </div>
                        </section>

                        <section id="installation" class="mt-12">
                            <h2 class="text-2xl font-semibold text-gray-900">Installation Guide</h2>
                            <div class="mt-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <h3 class="font-medium text-gray-900">System Requirements</h3>
                                        <ul class="mt-2 list-disc list-inside space-y-2 text-gray-600">
                                            <li>Windows 10/11 (64-bit)</li>
                                            <li>4GB RAM minimum</li>
                                            <li>Chrome browser installed</li>
                                            <li>Active internet connection</li>
                                        </ul>
                                    </div>
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <h3 class="font-medium text-gray-900">Download & Setup</h3>
                                        <ol class="mt-2 list-decimal list-inside space-y-2 text-gray-600">
                                            <li>Download the installer package</li>
                                            <li>Run as administrator</li>
                                            <li>Follow installation wizard</li>
                                            <li>Enter license key when prompted</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section id="user-manual" class="mt-12">
                            <h2 class="text-2xl font-semibold text-gray-900">User Manual</h2>
                            <div class="mt-6 space-y-6">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="font-medium text-gray-900">Getting Started</h3>
                                    <ol class="mt-2 list-decimal list-inside space-y-2 text-gray-600">
                                        <li>Launch the application</li>
                                        <li>Scan QR code with WhatsApp mobile</li>
                                        <li>Configure automation settings</li>
                                        <li>Start automation process</li>
                                    </ol>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <h3 class="font-medium text-gray-900">Key Features</h3>
                                        <ul class="mt-2 list-disc list-inside space-y-2 text-gray-600">
                                            <li>Bulk message sending</li>
                                            <li>Contact management</li>
                                            <li>Message templates</li>
                                            <li>Scheduled sending</li>
                                        </ul>
                                    </div>
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <h3 class="font-medium text-gray-900">Best Practices</h3>
                                        <ul class="mt-2 list-disc list-inside space-y-2 text-gray-600">
                                            <li>Respect sending limits</li>
                                            <li>Use message delays</li>
                                            <li>Keep software updated</li>
                                            <li>Regular backup contacts</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Existing sections... -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple search functionality
    const searchInput = document.getElementById('docsSearch');
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const sections = document.querySelectorAll('.prose section');
        
        sections.forEach(section => {
            const text = section.textContent.toLowerCase();
            section.style.display = text.includes(searchTerm) ? 'block' : 'none';
        });
    });

    // Enhanced scroll spy for better mobile support
    function updateActiveSection() {
        const sections = document.querySelectorAll('.prose section');
        const navLinks = document.querySelectorAll('nav a');
        
        let currentSection = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (window.scrollY >= (sectionTop - 150)) {
                currentSection = section.id;
            }
        });

        navLinks.forEach(link => {
            const href = link.getAttribute('href').substring(1);
            link.classList.remove('text-blue-600', 'bg-blue-50');
            if (href === currentSection) {
                link.classList.add('text-blue-600', 'bg-blue-50');
            }
        });
    }

    window.addEventListener('scroll', updateActiveSection);
    window.addEventListener('resize', updateActiveSection);
    document.addEventListener('DOMContentLoaded', updateActiveSection);
</script>
@endsection
