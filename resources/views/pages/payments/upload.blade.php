<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow-sm rounded-lg divide-y divide-gray-200">
            <!-- Header -->
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900">Complete Payment</h2>
                <p class="mt-1 text-sm text-gray-600">Step 2: Upload your payment proof</p>
            </div>

            <!-- Payment Details -->
            <div class="p-6">
                <div class="mb-8 text-center">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Summary</h3>
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Plan</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $payment->plan->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Reference Number</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $payment->reference_number }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $payment->paymentMethod->type)) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Amount</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                Subtotal: Rp. {{ number_format($payment->amount_before_tax) }}<br>
                                <span class="">Tax (11%): Rp. {{ number_format($payment->tax_amount) }}</span><br>
                                <span class="text-xl font-bold">Total: Rp. {{ number_format($payment->amount) }}</span>
                            </dd>
                        </div>
                    </dl>
                </div>

                <!-- Payment Account Info -->
                <div class="bg-gray-50 rounded-lg p-4 mb-8">
                    <h4 class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $payment->paymentMethod->type)) }} Details</h4>
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">{{ $payment->paymentMethod->provider }}</p>
                        <p class="font-mono text-gray-900">{{ $payment->paymentMethod->account_number }}</p>
                        <p class="text-sm text-gray-600">a.n. {{ $payment->paymentMethod->account_name }}</p>
                    </div>
                </div>

                <!-- Payment Deadline -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-8">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h4 class="ml-2 font-medium text-yellow-800">Payment Deadline</h4>
                    </div>
                    <p class="mt-1 text-sm text-yellow-700">Please complete your payment within:</p>
                    @php
                        $deadline = now()->addHour();
                        $expiresAt = $payment->expires_at ?? $deadline;
                    @endphp
                    <div class="mt-2 font-mono text-lg font-bold text-yellow-800" id="countdown" data-expires="{{ $expiresAt->timestamp }}">
                        <div class="text-base text-yellow-600">Payment expires in 1 hour</div>
                        <div>{{ $expiresAt->format('M d, Y H:i:s') }}</div>
                    </div>
                </div>

                <!-- Upload Form -->
                <form action="{{ route('payments.upload.store', $payment) }}" 
                      method="POST" 
                      enctype="multipart/form-data"
                      x-data="{ 
                          fileName: null,
                          filePreview: null,
                          handleFileSelect(event) {
                              const file = event.target.files[0];
                              if (file) {
                                  this.fileName = file.name;
                                  this.filePreview = URL.createObjectURL(file);
                              }
                          }
                      }">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Payment Proof</h3>
                            <div class="mt-4">
                                <!-- File Input -->
                                <div class="flex flex-col space-y-4">
                                    <div>
                                        <label for="proof" class="block text-sm font-medium text-gray-700">
                                            Upload bukti transfer pembayaran
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <input type="file"
                                               id="proof"
                                               name="proof"
                                               accept="image/*"
                                               required
                                               class="mt-1 border border-green-700 rounded-lg block w-full text-sm text-gray-500
                                                      file:mr-4 file:py-2 file:px-4
                                                      file:rounded-md file:border-0
                                                      file:text-sm file:font-medium
                                                      file:bg-green-50 file:text-green-700
                                                      hover:file:bg-green-100">
                                    </div>
                                </div>

                                @error('proof')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 disabled:opacity-50">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateCountdown() {
            const countdownElement = document.getElementById('countdown');
            const expiresAt = parseInt(countdownElement.dataset.expires) * 1000;
            
            const timer = setInterval(() => {
                const now = new Date().getTime();
                const distance = expiresAt - now;

                if (distance < 0) {
                    clearInterval(timer);
                    window.location.href = '{{ route('payments.create') }}';
                    return;
                }

                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownElement.textContent = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }, 1000);
        }

        updateCountdown();
    </script>
</x-app-layout>
