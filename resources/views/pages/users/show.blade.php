@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <!-- User Overview Card -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">User Details</h2>
                    <div class="flex space-x-4">
                        <a href="{{ route('users.edit', $user) }}" class="text-green-600 hover:text-green-800">Edit</a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-800">Back to List</a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- User Info -->
                <div class="col-span-1">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->name }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Joined</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }} WIB</dd>
                        </div>
                    </dl>
                </div>

                <!-- License Info -->
                <div class="col-span-1">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">License Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Active Licenses</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $totalLicenses > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $totalLicenses }} Active
                                </span>
                            </dd>
                        </div>
                        
                        @if($user->licenses->isNotEmpty())
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Last License Activity</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $lastLicenseActivity->created_at->format('d/m/Y H:i') }} WIB
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>

                <!-- Payment Summary -->
                <div class="col-span-1">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Summary</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Total Payments</dt>
                            <dd class="mt-1 text-sm text-gray-900">Rp. {{ number_format($totalPayments) }}</dd>
                        </div>
                        @if($user->payments->isNotEmpty())
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Last Payment</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->payments->first()->created_at->format('d/m/Y H:i') }} WIB
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>

        <!-- Recent Payments -->
        <div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Recent Payments</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($user->payments as $payment)
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Rp. {{ number_format($payment->amount) }}</p>
                                <p class="text-xs text-gray-500">{{ $payment->created_at->format('d/m/Y H:i') }} WIB</p>
                            </div>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $payment->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                           ($payment->status === 'pending_payment' ? 'bg-yellow-100 text-yellow-800' : 
                                            ($payment->status === 'pending_approval' ? 'bg-blue-100 text-blue-800' : 
                                             'bg-red-100 text-red-800')) }}">
                                        {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
                                    </span>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-sm text-gray-500 text-center">No payment history</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
