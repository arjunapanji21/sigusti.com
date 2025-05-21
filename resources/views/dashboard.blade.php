<x-app-layout>
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

            <!-- Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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
        @else
            @if($license)
                <!-- Welcome Message -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <h1 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}!</h1>
                    <p class="mt-1 text-blue-100">Here's your license and usage overview</p>
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
                    <a href="{{ route('download') }}" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-shadow duration-200 flex items-center">
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
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">License Status</h2>
                        <span class="px-3 py-1 rounded-full text-sm {{ $license->isValid() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $license->isValid() ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- License Details -->
                        <div class="space-y-4">
                            <div>
                                <label class="text-sm text-gray-500">License Key</label>
                                <p class="font-mono text-sm bg-gray-50 p-2 rounded">{{ $license->license_key }}</p>
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

                <!-- Enhanced Usage Stats -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Usage Analytics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="relative">
                                <div class="flex justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">Daily Usage</span>
                                    <span class="text-sm font-medium text-gray-700">{{ $license->daily_usage }}/{{ $license->daily_limit }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full transition-all duration-500" 
                         style="width: {{ min(($license->daily_usage / $license->daily_limit) * 100, 100) }}%"></div>
                                </div>
                                @if($license->daily_usage >= $license->daily_limit)
                                    <p class="text-xs text-red-600 mt-1">Daily limit reached</p>
                                @endif
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

                <!-- Recent Activity -->
                @if($recentActivity && $recentActivity->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Recent Activity</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @foreach($recentActivity as $activity)
                                <div class="p-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <span class="p-2 rounded-full {{ $activity->type === 'success' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-gray-900">{{ $activity->description }}</p>
                                            <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <!-- No License Warning -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-yellow-800 mb-2">No Active License</h2>
                    <p class="text-yellow-700">You don't have an active license. Please contact support to purchase a license.</p>
                </div>
            @endif
        @endif
    </div>
</x-app-layout>
