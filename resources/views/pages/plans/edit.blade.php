<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="">
            <div class="px-4 py-6 sm:px-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">{{ isset($plan) ? 'Edit Plan' : 'Create Plan' }}</h2>
                        <p class="mt-1 text-sm text-gray-500">{{ isset($plan) ? 'Update plan details and pricing' : 'Create a new subscription plan' }}</p>
                    </div>
                    <div>
                        <a href="{{ route('plans.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Plans
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="mt-6 bg-white shadow rounded-lg p-2">
            <!-- Tab Navigation with completion indicators -->
            <div class="border-b border-gray-200">
                <nav class="flex" aria-label="Progress">
                    <button type="button" onclick="showTab('basic')" class="tab-btn border-green-500 text-green-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Basic Information
                    </button>
                    <button type="button" onclick="showTab('limits')" class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Usage Limits
                    </button>
                    <button type="button" onclick="showTab('pricing')" class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Pricing & Discount
                    </button>
                </nav>
            </div>

            <div class="p-6">
                <form action="{{ isset($plan) ? route('plans.update', $plan) : route('plans.store') }}" method="POST">
                    @csrf
                    @if(isset($plan))
                        @method('PUT')
                    @endif

                    <!-- Basic Information Tab -->
                    <div id="basic-tab" class="tab-content">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div>
                                <div class="flex gap-1">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <span class="text-red-500">*</span>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name', $plan->name ?? '') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                            </div>

                            <div>
                                <div class="flex gap-1">
                                    <label for="duration_days" class="block text-sm font-medium text-gray-700">Duration (days)</label>
                                    <span class="text-red-500">*</span>
                                </div>
                                <input type="number" name="duration_days" id="duration_days" value="{{ old('duration_days', $plan->duration_days ?? '') }}" 
                                    class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="2" 
                                    class="mt-1 block w-full p-2 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('description', $plan->description ?? '') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $plan->is_active ?? true) ? 'checked' : '' }} 
                                            class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-500 focus:ring-green-500">
                                        <span class="ml-2 text-sm text-gray-600">Active</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Usage Limits Tab -->
                    <div id="limits-tab" class="tab-content hidden">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2 lg:grid-cols-3">
                            <div>
                                <div class="flex gap-1">
                                    <label for="daily_limit" class="block text-sm font-medium text-gray-700">Daily Message Limit</label>
                                    <span class="text-red-500">*</span>
                                </div>
                                <input type="number" name="daily_limit" id="daily_limit" value="{{ old('daily_limit', $plan->daily_limit ?? '') }}" 
                                    class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                            </div>

                            <div>
                                <div class="flex gap-1">
                                    <label for="monthly_limit" class="block text-sm font-medium text-gray-700">Monthly Message Limit</label>
                                    <span class="text-red-500">*</span>
                                </div>
                                <input type="number" name="monthly_limit" id="monthly_limit" value="{{ old('monthly_limit', $plan->monthly_limit ?? '') }}" 
                                    class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                            </div>

                            <div>
                                <div class="flex gap-1">
                                    <label for="max_device" class="block text-sm font-medium text-gray-700">Maximum Devices</label>
                                    <span class="text-red-500">*</span>
                                </div>
                                <input type="number" name="max_device" id="max_device" value="{{ old('max_device', $plan->max_device ?? '') }}" 
                                    class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Tab -->
                    <div id="pricing-tab" class="tab-content hidden">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div class="flex flex-col gap-4">
                                <div>
                                    <div class="flex gap-1">
                                        <label for="price" class="block text-sm font-medium text-gray-700">Regular Price</label>
                                        <span class="text-red-500">*</span>
                                    </div>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">Rp.</span>
                                        </div>
                                        <input type="number" name="price" id="price" value="{{ old('price', $plan->price ?? '') }}" 
                                            onchange="calculateDiscount()"
                                            onkeyup="calculateDiscount()"
                                            class="pl-10 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                    </div>
                                </div>
    
                                <div>
                                    <label for="discount_percentage" class="block text-sm font-medium text-gray-700">Discount Percentage</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="number" name="discount_percentage" id="discount_percentage" min="0" max="100" 
                                            value="{{ old('discount_percentage', $plan->discount_percentage ?? '') }}" 
                                            onchange="calculateDiscount()"
                                            onkeyup="calculateDiscount()"
                                            class="block p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="my-2 p-4 bg-gray-50 rounded-lg">
                                <div class="text-sm text-gray-700 font-medium mb-2">Price Summary:</div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">Regular Price:</span>
                                    <span id="original_price" class="text-sm font-medium">Rp. {{ number_format(old('price', $plan->price ?? 0)) }}</span>
                                </div>
                                <div class="flex justify-between items-center mt-1">
                                    <span class="text-sm text-gray-500">Discount Amount:</span>
                                    <span id="discount_amount" class="text-sm font-medium text-red-600">-Rp. 0</span>
                                </div>
                                <div class="flex justify-between items-center mt-1 pt-2 border-t">
                                    <span class="text-sm text-gray-700 font-medium">Final Price:</span>
                                    <span id="final_price" class="text-sm font-medium text-green-600">Rp. {{ number_format(old('price', $plan->price ?? 0)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Progress -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="text-sm text-gray-600">
                                    Fields marked with <span class="text-red-500">*</span> are required
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('plans.index') }}" class="rounded-md bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Cancel</a>
                                <button type="submit" class="rounded-md bg-green-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            
            // Show selected tab
            document.getElementById(tabName + '-tab').classList.remove('hidden');
            
            // Update tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-green-500', 'text-green-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Highlight active tab
            const activeBtn = document.querySelector(`button[onclick="showTab('${tabName}')"]`);
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
            activeBtn.classList.add('border-green-500', 'text-green-600');
        }

        function calculateDiscount() {
            const price = parseInt(document.getElementById('price').value) || 0;
            const discount = parseInt(document.getElementById('discount_percentage').value) || 0;
            const finalPriceElement = document.getElementById('final_price');
            const originalPriceElement = document.getElementById('original_price');
            const discountAmountElement = document.getElementById('discount_amount');

            const discountAmount = Math.round(price * discount / 100);
            const finalPrice = price - discountAmount;

            // Update display
            originalPriceElement.textContent = `Rp. ${numberFormat(price)}`;
            discountAmountElement.textContent = `-Rp. ${numberFormat(discountAmount)}`;
            finalPriceElement.textContent = `Rp. ${numberFormat(finalPrice)}`;

            // Show/hide discount amount
            discountAmountElement.classList.toggle('hidden', !discount);
        }

        // Initialize the calculation when tab is shown
        document.querySelector('button[onclick="showTab(\'pricing\')"]').addEventListener('click', calculateDiscount);

        // Calculate on page load if we're in edit mode and price tab is visible
        if (!document.getElementById('pricing-tab').classList.contains('hidden')) {
            calculateDiscount();
        }
        
        function numberFormat(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        // Show first tab by default
        showTab('basic');
    </script>
</x-app-layout>
