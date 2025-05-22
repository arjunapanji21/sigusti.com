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

        @if ($errors->any())
            <x-alert type="error" class="mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Payment Instructions</h2>
                    <a href="{{ route('subscription.index') }}" class="text-blue-600 hover:text-blue-800">
                        Back to Subscription
                    </a>
                </div>
            </div>
            
            <div class="p-6 space-y-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="font-semibold text-gray-900">Order Summary</h3>
                    <dl class="mt-4 space-y-2">
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Plan</dt>
                            <dd class="text-gray-900">{{ $plan->name }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Duration</dt>
                            <dd class="text-gray-900">{{ $plan->duration_days }} days</dd>
                        </div>
                        <div class="flex justify-between font-semibold">
                            <dt class="text-gray-900">Total Amount</dt>
                            <dd class="text-gray-900">${{ number_format($payment->amount / 100, 2) }}</dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-900 mb-4">Payment Details</h3>
                    <p class="text-gray-600 mb-2">Reference Number: {{ $payment->reference_number }}</p>
                    <p class="text-gray-600">Please include this reference number in your payment.</p>
                </div>

                <div class="space-y-4">
                    <h3 class="font-semibold text-gray-900">Bank Transfer Instructions</h3>
                    <div class="border rounded-lg p-4">
                        <p class="font-medium">Bank Name: YOUR BANK NAME</p>
                        <p class="font-medium">Account Number: YOUR ACCOUNT NUMBER</p>
                        <p class="font-medium">Account Name: YOUR ACCOUNT NAME</p>
                    </div>
                </div>

                <div class="mt-6">
                    <form action="{{ route('subscription.confirm-payment') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                        
                        <div class="space-y-4">
                            <div>
                                <label for="proof_of_payment" class="block text-sm font-medium text-gray-700">
                                    Upload Proof of Payment
                                </label>
                                <input type="file" name="proof_of_payment" id="proof_of_payment" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-600
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-medium
                                        file:bg-blue-50 file:text-blue-700
                                        hover:file:bg-blue-100">
                                <p class="mt-1 text-sm text-gray-500">Upload a clear image of your payment receipt</p>
                            </div>

                            <div>
                                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                    Confirm Payment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
