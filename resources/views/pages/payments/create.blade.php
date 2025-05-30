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
                           @if(auth()->user()->can('admin-actions') || $plan->price > 0)
                           <label class="relative border rounded-lg p-4 flex flex-col cursor-pointer focus-within:ring-2 focus-within:ring-green-500">
                            <input type="radio" name="plan_id" value="{{ $plan->id }}" class="sr-only" required
                                data-original-price="{{ $plan->price }}"
                                data-sale-price="{{ $plan->isOnSale() ? $plan->sale_price : $plan->price }}"
                                data-yearly-price="{{ $plan->yearly_price }}"
                                onchange="updateSelectedPlan(this)">
                            <span class="flex-1">
                                <span class="block text-sm font-medium text-gray-900">{{ $plan->name }}</span>
                                @if($plan->isOnSale())
                                    <span class="mt-1 flex items-center text-sm text-gray-500 price-display">
                                        <span class="line-through original-price">Rp. {{ number_format($plan->price) }}</span>
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Save {{ $plan->discount_percentage }}%
                                        </span>
                                    </span>
                                    <span class="text-lg font-bold text-gray-900 final-price">Rp. {{ number_format($plan->sale_price) }}</span>
                                @else
                                    <span class="text-lg font-bold text-gray-900 final-price">Rp. {{ number_format($plan->price) }}</span>
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
                           @endif
                        @endforeach
                    </div>
                </div>

                <!-- Payment Frequency -->
                <div class="grid grid-cols-2 items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Frequency</h3>
                    <select name="payment_frequency" id="payment_frequency" class="block w-full p-2 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </div>

                <!-- Payment Method Selection -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Method</h3>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach($bankTransfers as $method)
                            <label class="relative border rounded-lg p-4 flex cursor-pointer focus-within:ring-2 focus-within:ring-green-500">
                                <input type="radio" name="payment_method_id" value="{{ $method->id }}" class="sr-only" required
                                    data-type="{{ $method->type }}"
                                    onchange="updatePaymentMethod('{{ $method->type }}', {{ $method->id }})">
                                <span class="flex items-center">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                    <span class="ml-3">
                                        <span class="block text-sm font-medium text-gray-900">{{ $method->provider.' / '.$method->account_number }}</span>
                                        <span class="block text-sm text-gray-500">a.n. {{ $method->account_name }}</span>
                                    </span>
                                </span>
                            </label>
                        @endforeach
                        
                        @foreach($ewallets as $method)
                            <label class="relative border rounded-lg p-4 flex cursor-pointer focus-within:ring-2 focus-within:ring-green-500">
                                <input type="radio" name="payment_method_id" value="{{ $method->id }}" class="sr-only" required
                                    data-type="{{ $method->type }}"
                                    onchange="updatePaymentMethod('{{ $method->type }}', {{ $method->id }})">
                                <span class="flex items-center">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <span class="ml-3">
                                        <span class="block text-sm font-medium text-gray-900">{{ $method->provider.' / '.$method->account_number }}</span>
                                        <span class="block text-sm text-gray-500">a.n. {{ $method->account_name }}</span>
                                    </span>
                                </span>
                            </label>
                        @endforeach
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
        function updateSelectedPlan(radio) {
            // Add visual feedback for selected plan
            document.querySelectorAll('[name="plan_id"]').forEach(input => {
                const card = input.closest('label');
                card.classList.toggle('ring-2', input.checked);
                card.classList.toggle('ring-green-500', input.checked);
            });
        }

        function updatePriceDisplay() {
            const frequency = document.getElementById('payment_frequency').value;
            const planInputs = document.querySelectorAll('input[name="plan_id"]');
            
            planInputs.forEach(input => {
                const card = input.closest('label');
                const originalPriceSpan = card.querySelector('.original-price');
                const finalPriceSpan = card.querySelector('.final-price');
                
                if (frequency == 'yearly') {
                    const yearlyPrice = parseInt(input.dataset.yearlyPrice);
                    if (originalPriceSpan) {
                        originalPriceSpan.textContent = 'Rp. ' + (parseInt(input.dataset.originalPrice) * 12).toLocaleString();
                    }
                    finalPriceSpan.textContent = 'Rp. ' + yearlyPrice.toLocaleString();
                } else {
                    if (originalPriceSpan) {
                        originalPriceSpan.textContent = 'Rp. ' + parseInt(input.dataset.originalPrice).toLocaleString();
                    }
                    finalPriceSpan.textContent = 'Rp. ' + parseInt(input.dataset.salePrice).toLocaleString();
                }
            });
        }

        // Add event listener for payment frequency changes
        document.getElementById('payment_frequency').addEventListener('change', updatePriceDisplay);

        // Initial price display update
        document.addEventListener('DOMContentLoaded', updatePriceDisplay);

        function updatePaymentMethod(type, methodId) {
            document.getElementById('bank_transfer_instructions').classList.add('hidden');
            document.getElementById('e-wallet_instructions').classList.add('hidden');
            document.getElementById(type + '_instructions').classList.remove('hidden');
        }
    </script>
</x-app-layout>
