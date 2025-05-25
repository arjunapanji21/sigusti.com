@extends('layouts.app')

@section('content')
<div class="space-y-6">
    @if(auth()->user()->is_admin)
        <!-- Admin Dashboard -->
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 bg-opacity-75">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-gray-500">Total Users</p>
                        <h3 class="text-3xl font-bold text-gray-700">{{ number_format($totalUsers) }}</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 bg-opacity-75">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-gray-500">Active Licenses</p>
                        <h3 class="text-3xl font-bold text-gray-700">{{ number_format($activeLicenses) }}</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 bg-opacity-75">
                        <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-gray-500">Total Licenses</p>
                        <h3 class="text-3xl font-bold text-gray-700">{{ number_format($totalLicenses) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 bg-opacity-75">
                        <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-gray-500">This Month Revenue</p>
                        <h3 class="text-3xl font-bold text-gray-700">{{ number_format($monthlyRevenue) }}</h3>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 bg-opacity-75">
                        <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <p class="text-gray-500">This Year Revenue</p>
                        <h3 class="text-3xl font-bold text-gray-700">{{ number_format($yearlyRevenue) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Activity -->
            <div class="lg:col-span-2 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Users -->
                <div class="bg-white shadow rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Users</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($recentUsers as $user)
                            <div class="p-4 flex items-center">
                                <img class="h-10 w-10 rounded-full" src="{{ $user->profile_photo_url }}" alt="">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                                <span class="ml-auto text-xs text-gray-500">
                                    Joined {{ $user->created_at->diffForHumans() }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Expiring Licenses -->
                <div class="bg-white shadow rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Expiring Licenses</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($expiringLicenses as $license)
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $license->user->name }}</p>
                                        <p class="text-xs text-gray-500">License: {{ Str::limit($license->license_key, 20) }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                        Expires {{ $license->expires_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">System Health</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-500">Server Load</span>
                            <span class="text-sm font-medium text-gray-900">{{ $serverLoad }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $serverLoad }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-500">API Usage</span>
                            <span class="text-sm font-medium text-gray-900">{{ number_format($apiRequests) }} reqs/min</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ min(($apiRequests / 1000) * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Events -->
                <div class="mt-6">
                    <h4 class="text-sm font-medium text-gray-500 mb-3">Recent Events</h4>
                    <div class="space-y-3">
                        @foreach($systemEvents as $event)
                        <div class="flex items-start">
                            <span class="flex-shrink-0 w-2 h-2 mt-1.5 rounded-full {{ $event->type === 'error' ? 'bg-red-600' : 'bg-green-600' }}"></span>
                            <div class="ml-3">
                                <p class="text-sm text-gray-600">{{ $event->message }}</p>
                                <p class="text-xs text-gray-400">{{ $event->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Payments (formerly Transactions) -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Recent Payments</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentPayments as $payment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full" src="{{ $payment->user->profile_photo_url }}" alt="">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $payment->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $payment->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $payment->plan->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Rp. {{ number_format($payment->amount) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $payment->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $payment->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $payment->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        @if($licenses)
            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-green-400 to-green-500 rounded-lg shadow-lg p-6 text-white">
                <h1 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="mt-1 text-green-100">Here's your licenses and usage overview</p>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('support') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-200 flex items-center">
                    <span class="p-2 bg-blue-100 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-gray-900">Get Help</h3>
                        <p class="text-sm text-gray-500">Contact support</p>
                    </div>
                </a>
                <a href="{{ route('documentation') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-200 flex items-center">
                    <span class="p-2 bg-green-100 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-gray-900">Documentation</h3>
                        <p class="text-sm text-gray-500">View guides & docs</p>
                    </div>
                </a>
                <a href="{{route('download.index')}}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-200 flex items-center">
                    <span class="p-2 bg-purple-100 rounded-lg mr-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </span>
                    <div>
                        <h3 class="font-semibold text-gray-900">Download App</h3>
                        <p class="text-sm text-gray-500">Get desktop client</p>
                    </div>
                </a>
            </div>

            <!-- User Dashboard -->
            <!-- License Status Card -->
            @foreach($licenses as $license)
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">License Status</h2>
                    <div class="flex gap-2 items-center">
                        <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                            {{ $license->plan->name }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm {{ $license->isValid() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $license->isValid() ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- License Details -->
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-500">License Key</label>
                            <div class="relative">
                                <p id="license-{{ $license->id }}" class="font-mono text-sm bg-gray-50 p-2 rounded">
                                    <span class="license-text">{{ str_repeat('•', 20) }}</span>
                                    <span class="license-key hidden">{{ $license->license_key }}</span>
                                </p>
                                <div class="absolute right-2 top-2 flex space-x-2">
                                    <button onclick="toggleLicense('{{ $license->id }}')" class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <button onclick="copyLicense('{{ $license->id }}')" class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Expiration Date</label>
                            <p class="font-semibold {{ $license->expires_at->isPast() ? 'text-red-600' : 'text-gray-700' }}">
                                {{ $license->expires_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Usage Stats -->
                    <div class="space-y-4">
                        <!-- Daily Usage -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <label class="text-sm text-gray-500">Daily Usage</label>
                                <span class="text-sm text-gray-700">{{ $license->daily_usage }}/{{ $license->daily_limit }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ ($license->daily_usage / $license->daily_limit) * 100 }}%"></div>
                            </div>
                        </div>
                        
                        <!-- Monthly Usage -->
                        <div>
                            <div class="flex justify-between mb-1">
                                <label class="text-sm text-gray-500">Monthly Usage</label>
                                <span class="text-sm text-gray-700">{{ $license->monthly_usage }}/{{ $license->monthly_limit }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($license->monthly_usage / $license->monthly_limit) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Desktop App Integration -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Desktop Application Integration</h3>
                <div class="prose max-w-none">
                    <p class="text-gray-600">To use this license with the WhatsApp Web Auto desktop application:</p>
                    <ol class="list-decimal list-inside space-y-2 mt-4">
                        <li>Download and install WhatsApp Web Auto desktop application</li>
                        <li>Copy your license key shown above</li>
                        <li>Paste the license key in the application settings</li>
                        <li>The application will automatically verify and manage your usage limits</li>
                    </ol>
                </div>
            </div>

            <!-- New Help & Resources Section -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Help & Resources</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900 mb-2">Quick Start Guide</h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• Download the desktop application</li>
                            <li>• Install and launch the app</li>
                            <li>• Enter your license key</li>
                            <li>• Start automating WhatsApp Web</li>
                        </ul>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900 mb-2">Need Help?</h4>
                        <p class="text-sm text-gray-600 mb-3">Our support team is here to help you with any questions.</p>
                        <a href="{{ route('support') }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-500">
                            Contact Support
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- No License Warning -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-yellow-800 mb-2">No Active License</h2>
                <p class="text-yellow-700">You don't have an active license. Please contact support to purchase a license.</p>
            </div>
        @endif
    @endif
</div>
@endsection
