@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        @if (session('success'))
            <x-alert type="success" :message="session('success')" class="mb-6" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" class="mb-6" />
        @endif

        @if (session('warning'))
            <x-alert type="warning" :message="session('warning')" class="mb-6" />
        @endif

        @if(auth()->user()->is_admin)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Payment Management</h2>
                </div>
                
                <div class="bg-white divide-y divide-gray-200">
                    @forelse($payments as $payment)
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">
                                        {{ $payment->user->name }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Plan: {{ $payment->plan->name }} - {{ $payment->amount_formatted }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Status: <span class="capitalize">{{ $payment->status }}</span>
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('subscription.show', $payment) }}" class="text-blue-600 hover:text-blue-800">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            No payments found.
                        </div>
                    @endforelse
                </div>

                @if($payments->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        {{ $payments->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="space-y-6">
                @if($currentSubscription)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-4">Current Subscription</h2>
                        <div class="bg-gray-50 rounded p-4">
                            <p class="text-gray-600">Plan: {{ $currentSubscription->plan->name }}</p>
                            <p class="text-gray-600">Status: <span class="capitalize">{{ $currentSubscription->status }}</span></p>
                            <p class="text-gray-600">Expires: {{ $currentSubscription->expires_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Payment History -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Payment History</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($userPayments ?? [] as $payment)
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900">{{ $payment->plan->name }}</h3>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Amount: {{ number_format($payment->amount, 2) }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Reference: {{ $payment->reference_number }}
                                        </p>
                                        <p class="text-sm">
                                            <span class="capitalize 
                                                @if($payment->status === 'approved') text-green-600
                                                @elseif($payment->status === 'pending') text-yellow-600
                                                @elseif($payment->status === 'rejected') text-red-600
                                                @endif font-medium">
                                                {{ $payment->status }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        @if($payment->status === 'pending')
                                            <a href="{{ route('subscription.show', $payment) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600">
                                                Upload Payment Proof
                                            </a>
                                        @endif
                                        @if($payment->proof_of_payment)
                                            <a href="{{ route('subscription.show', $payment) }}" 
                                               class="text-blue-600 hover:text-blue-800 text-sm">
                                                View Details
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-gray-500">
                                No payment history found.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Available Plans -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Available Plans</h2>
                    </div>
                    
                    <div class="grid gap-6 p-6 md:grid-cols-3">
                        @foreach($plans as $plan)
                            <div class="border rounded-lg p-6 flex flex-col">
                                <h3 class="text-lg font-semibold">{{ $plan->name }}</h3>
                                <p class="text-3xl font-bold mt-4">${{ number_format($plan->price / 100, 2) }}</p>
                                <p class="text-gray-500 mt-2">{{ $plan->duration_days }} days</p>
                                <div class="mt-6">
                                    <form action="{{ route('subscription.purchase', $plan) }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                                            <select name="payment_method" id="payment_method" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                                <option value="">Select payment method</option>
                                                <option value="bank_transfer">Bank Transfer</option>
                                                <option value="e_wallet">E-Wallet</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                            Purchase
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
