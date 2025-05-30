<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow-sm rounded-lg divide-y divide-gray-200">
            <!-- Payment Header -->
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Payment Details</h2>
                        <p class="mt-1 text-sm text-gray-600">Transaction #{{ $payment->id }}</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('payments.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-green-600 bg-white hover:bg-gray-50">
                            Back to Payments
                        </a>
                        @can('admin-actions')
                            @if($payment->status != 'approved' && $payment->status != 'rejected')
                                <form action="{{ route('payments.approve', $payment) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="cursor-pointer inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                        Approve Payment
                                    </button>
                                </form>
                                <form action="{{ route('payments.reject', $payment) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-red-600 bg-white hover:bg-gray-50">
                                        Reject Payment
                                    </button>
                                </form>
                            @endif
                        @endcan
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="p-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Payment Information</h3>
                    <dl class="mt-4 space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Amount</dt>
                            <dd class="mt-1 text-sm text-gray-900">Rp. {{ number_format($payment->amount) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $payment->status == 'approved' ? 'bg-green-100 text-green-800' : 
                                       ($payment->status == 'pending_payment' ? 'bg-yellow-100 text-yellow-800' : 
                                        ($payment->status == 'pending_approval' ? 'bg-blue-100 text-blue-800' : 
                                         'bg-red-100 text-red-800')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $payment->created_at->format('M d, Y H:i') }}</dd>
                        </div>
                        <!-- Add Download Invoice Button -->
                        <div class="mt-4">
                            <a href="{{ route('payments.invoice.download', $payment) }}" 
                               class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                Download Invoice
                            </a>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900">Plan Details</h3>
                    <dl class="mt-4 space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Plan Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $payment->plan->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Duration</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $payment->payment_frequency == 'yearly' ? $payment->plan->duration_days * 12 : $payment->plan->duration_days }} days</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Features</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <ul class="list-disc list-inside">
                                    <li>{{ number_format($payment->plan->daily_limit) }} daily messages</li>
                                    <li>{{ number_format($payment->plan->monthly_limit) }} monthly messages</li>
                                    <li>{{ $payment->plan->max_device }} devices</li>
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Payment Proof -->
            @if($payment->proof_of_payment)
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Proof of Payment</h3>
                    <div class="relative rounded-lg overflow-hidden bg-gray-100" style="max-width: 600px">
                        <img src="{{ Storage::url($payment->proof_of_payment) }}" 
                             alt="Payment Proof" 
                             class="w-full h-auto"
                             style="max-height: 400px; object-fit: contain;">
                    </div>
                </div>
            @elseif(!$payment->isExpired() && $payment->status == 'pending_payment')
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">No Proof of Payment Uploaded</h3>
                    <p class="text-sm text-gray-500 mb-4">Please upload your proof of payment to complete the transaction.</p>
                    <a href="{{ route('payments.upload', $payment) }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        Upload Bukti Pembayaran
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
