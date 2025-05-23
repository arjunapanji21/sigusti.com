<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow-sm rounded-lg divide-y divide-gray-200">
            <!-- Header -->
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900">New Payment</h2>
                <p class="mt-1 text-sm text-gray-600">Step 1: Choose your plan and payment method</p>
            </div>

            <!-- Payment Form -->
            <form action="{{ route('payments.initiate') }}" method="POST" class="p-6 space-y-8">
                @csrf

                <!-- Plan Selection -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Select Plan</h3>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($plans as $plan)
                            <label class="relative border rounded-lg p-4 flex flex-col cursor-pointer focus-within:ring-2 focus-within:ring-green-500">
                                <input type="radio" name="plan_id" value="{{ $plan->id }}" class="sr-only" required
                                    onchange="updateSelectedPlan({{ $plan->price }}, {{ $plan->isOnSale() ? $plan->sale_price : $plan->price }})">
                                <span class="flex-1">
                                    <span class="block text-sm font-medium text-gray-900">{{ $plan->name }}</span>
                                    @if($plan->isOnSale())
                                        <span class="mt-1 flex items-center text-sm text-gray-500">
                                            <span class="line-through">Rp. {{ number_format($plan->price) }}</span>
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Save {{ $plan->discount_percentage }}%
                                            </span>
                                        </span>
                                        <span class="text-lg font-bold text-gray-900">Rp. {{ number_format($plan->sale_price) }}</span>
                                    @else
                                        <span class="mt-1 text-lg font-bold text-gray-900">Rp. {{ number_format($plan->price) }}</span>
                                    @endif
                                </span>
                                <span class="mt-4 border-t pt-4">
                                    <span class="block text-sm text-gray-500">Features:</span>
                                    <ul class="mt-2 space-y-2 text-sm text-gray-500">
                                        <li class="flex items-center">
                                            <svg class="h-4 w-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ number_format($plan->daily_limit) }} daily messages
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="h-4 w-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ number_format($plan->monthly_limit) }} monthly messages
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="h-4 w-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ $plan->max_device }} devices
                                        </li>
                                    </ul>
                                </span>
                                <!-- Selected indicator -->
                                <span class="absolute inset-0 rounded-lg ring-2 ring-transparent peer-checked:ring-green-500" aria-hidden="true"></span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Method Selection -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Method</h3>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <!-- Bank Transfer -->
                        <label class="relative border rounded-lg p-4 flex cursor-pointer focus-within:ring-2 focus-within:ring-green-500">
                            <input type="radio" name="payment_method" value="bank_transfer" class="sr-only" required
                                onchange="updatePaymentMethod('bank')">
                            <span class="flex items-center">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                <span class="ml-3">
                                    <span class="block text-sm font-medium text-gray-900">Bank Transfer</span>
                                    <span class="block text-sm text-gray-500">Transfer to our bank account</span>
                                </span>
                            </span>
                        </label>

                        <!-- E-Wallet -->
                        <label class="relative border rounded-lg p-4 flex cursor-pointer focus-within:ring-2 focus-within:ring-green-500">
                            <input type="radio" name="payment_method" value="ewallet" class="sr-only" required
                                onchange="updatePaymentMethod('ewallet')">
                            <span class="flex items-center">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="ml-3">
                                    <span class="block text-sm font-medium text-gray-900">E-Wallet</span>
                                    <span class="block text-sm text-gray-500">Pay with DANA, OVO, or GoPay</span>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Payment Instructions -->
                <div id="bank_instructions" class="hidden">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900">Bank Transfer Instructions</h4>
                        <div class="mt-2 space-y-3">
                            <div class="flex justify-between items-center p-3 bg-white rounded border">
                                <div>
                                    <p class="text-sm text-gray-600">Bank BCA</p>
                                    <p class="font-mono text-gray-900">1234567890</p>
                                    <p class="text-sm text-gray-600">a.n. WAWA PROJECT</p>
                                </div>
                                <button type="button" onclick="copyToClipboard('1234567890')" class="text-green-600 hover:text-green-700">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="ewallet_instructions" class="hidden">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900">E-Wallet Payment</h4>
                        <div class="mt-2 space-y-3">
                            <div class="flex justify-between items-center p-3 bg-white rounded border">
                                <div>
                                    <p class="text-sm text-gray-600">DANA / OVO / GoPay</p>
                                    <p class="font-mono text-gray-900">081234567890</p>
                                    <p class="text-sm text-gray-600">a.n. WAWA PROJECT</p>
                                </div>
                                <button type="button" onclick="copyToClipboard('081234567890')" class="text-green-600 hover:text-green-700">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Deadline Notice -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="ml-2 text-sm text-blue-700">
                            You'll have 1 hour to complete the payment after initiating.
                        </p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        Continue to Payment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateSelectedPlan(originalPrice, finalPrice) {
            // Add visual feedback for selected plan
            document.querySelectorAll('[name="plan_id"]').forEach(radio => {
                const card = radio.closest('label');
                card.classList.toggle('ring-2', radio.checked);
                card.classList.toggle('ring-green-500', radio.checked);
            });
        }

        function updatePaymentMethod(method) {
            document.getElementById('bank_instructions').classList.add('hidden');
            document.getElementById('ewallet_instructions').classList.add('hidden');
            document.getElementById(method + '_instructions').classList.remove('hidden');
        }
    </script>
</x-app-layout>
