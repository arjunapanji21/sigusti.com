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
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Summary</h3>
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Plan</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $payment->plan->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Amount</dt>
                            <dd class="mt-1 text-sm text-gray-900">Rp. {{ number_format($payment->amount) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Reference Number</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $payment->reference_number }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Payment Account Info -->
                @if($payment->payment_method === 'bank_transfer')
                    <div class="bg-gray-50 rounded-lg p-4 mb-8">
                        <h4 class="font-medium text-gray-900">Bank Account Details</h4>
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">Bank BCA</p>
                            <p class="font-mono text-gray-900">1234567890</p>
                            <p class="text-sm text-gray-600">a.n. WAWA PROJECT</p>
                        </div>
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-4 mb-8">
                        <h4 class="font-medium text-gray-900">E-Wallet Details</h4>
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">DANA / OVO / GoPay</p>
                            <p class="font-mono text-gray-900">081234567890</p>
                            <p class="text-sm text-gray-600">a.n. WAWA PROJECT</p>
                        </div>
                    </div>
                @endif

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
                          isDragging: false,
                          isUploading: false,
                          fileName: null,
                          filePreview: null,
                          errorMessage: null,
                          
                          handleDrop(event) {
                              this.isDragging = false;
                              const file = event.dataTransfer.files[0];
                              this.validateAndPreview(file);
                          },
                          
                          handleFileSelect(event) {
                              const file = event.target.files[0];
                              this.validateAndPreview(file);
                          },
                          
                          validateAndPreview(file) {
                              // Reset previous error
                              this.errorMessage = null;
                              
                              // Validate file type
                              if (!file.type.match('image.*')) {
                                  this.errorMessage = 'Please upload an image file';
                                  return;
                              }
                              
                              // Validate file size (2MB)
                              if (file.size > 2 * 1024 * 1024) {
                                  this.errorMessage = 'File size should not exceed 2MB';
                                  return;
                              }
                              
                              this.fileName = file.name;
                              this.filePreview = URL.createObjectURL(file);
                          },
                          
                          resetFile() {
                              this.fileName = null;
                              this.filePreview = null;
                              this.errorMessage = null;
                              document.getElementById('proof').value = '';
                          }
                      }"
                      @submit="isUploading = true">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Upload Payment Proof</h3>
                            <div class="mt-2">
                                <div class="relative"
                                     x-on:dragover.prevent="isDragging = true"
                                     x-on:dragleave.prevent="isDragging = false"
                                     x-on:drop.prevent="handleDrop($event)">
                                    
                                    <!-- Upload Area -->
                                    <div class="flex justify-center px-6 pt-5 pb-6 border-2 transition-colors duration-150"
                                         :class="{
                                             'border-dashed border-gray-300': !isDragging && !filePreview,
                                             'border-solid border-green-500 bg-green-50': isDragging,
                                             'border-solid border-gray-300': filePreview
                                         }">
                                        
                                        <!-- Empty State -->
                                        <div class="space-y-1 text-center" x-show="!filePreview">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 justify-center">
                                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500">
                                                    <span>Upload a file</span>
                                                    <input id="proof" name="proof" type="file" class="sr-only" accept="image/*" x-on:change="handleFileSelect($event)">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                        </div>

                                        <!-- Preview -->
                                        <div x-show="filePreview" class="w-full relative">
                                            <button type="button" 
                                                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-500"
                                                    x-on:click="resetFile">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <img :src="filePreview" class="mx-auto max-h-64 object-contain rounded-lg">
                                            <p class="mt-2 text-sm text-gray-500 text-center" x-text="fileName"></p>
                                        </div>
                                    </div>

                                    <!-- Error Message -->
                                    <div x-show="errorMessage" class="mt-2 text-sm text-red-600" x-text="errorMessage"></div>
                                    @error('proof')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 disabled:opacity-50"
                                    :disabled="isUploading || !filePreview">
                                <span x-show="isUploading">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Uploading...
                                </span>
                                <span x-show="!isUploading">
                                    Submit Payment Proof
                                </span>
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
