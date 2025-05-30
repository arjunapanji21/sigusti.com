@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white shadow-sm rounded-lg divide-y divide-gray-200">
        <!-- License Header -->
        <div class="p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">License Details</h2>
                    <p class="mt-1 text-sm text-gray-600">Detailed information about this license</p>
                </div>
                @can('admin-actions')
                    @if($license->is_active)
                        <form action="{{ route('licenses.deactivate', $license) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                                Deactivate License
                            </button>
                        </form>
                    @else
                        <form action="{{ route('licenses.activate', $license) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                Activate License
                            </button>
                        </form>
                    @endif
                @endcan
            </div>
        </div>

        <!-- License Info -->
        <div class="p-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
            <div>
                <h3 class="text-lg font-medium text-gray-900">License Information</h3>
                <dl class="mt-4 space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">License Key</dt>
                        <dd class="mt-1 relative">
                            <p id="license-{{ $license->id }}" class="font-mono text-sm bg-gray-50 p-2 rounded">
                                <span class="license-text">{{ str_repeat('•', 20) }}</span>
                                <span class="license-key hidden">{{ $license->license_key }}</span>
                            </p>
                            <div class="absolute right-2 top-1/2 -translate-y-1/2 flex space-x-2">
                                <button onclick="toggleLicense('{{ $license->id }}')" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button onclick="copyLicense('{{ $license->id }}')" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                    </svg>
                                </button>
                            </div>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $license->isValid() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $license->isValid() ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Expiration Date</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $license->expires_at->format('M d, Y') }}</dd>
                    </div>
                </dl>
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-900">Usage Statistics</h3>
                <div class="mt-4 space-y-6">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-500">Daily Usage</span>
                            <span class="text-sm font-medium text-gray-900">{{ $license->daily_usage }}/{{ $license->daily_limit }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ min(($license->daily_usage / $license->daily_limit) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm font-medium text-gray-500">Monthly Usage</span>
                            <span class="text-sm font-medium text-gray-900">{{ $license->monthly_usage }}/{{ $license->monthly_limit }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(($license->monthly_usage / $license->monthly_limit) * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
            <div class="flow-root">
                <ul class="-mb-8">
                    @foreach($license->activities()->latest()->take(5)->get() as $activity)
                        <li class="relative pb-8">
                            @if(!$loop->last)
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            @endif
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-600">{{ $activity->details }}</p>
                                    </div>
                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection