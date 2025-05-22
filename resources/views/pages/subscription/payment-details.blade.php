@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Payment Details</h2>
                    <a href="{{ route('subscription.index') }}" class="text-blue-600 hover:text-blue-800">
                        Back to Subscription
                    </a>
                </div>
            </div>
            
            <div class="p-6 space-y-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">User</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $payment->user->name }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Plan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $payment->plan->name }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Amount</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $payment->amount_formatted }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $payment->status }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                        <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $payment->payment_method }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Reference Number</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $payment->reference_number }}</dd>
                    </div>
                </dl>

                @if($payment->proof_of_payment)
                    <div class="sm:col-span-2 mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Proof of Payment</h3>
                        <img src="{{ Storage::url($payment->proof_of_payment) }}" alt="Proof of Payment" class="max-w-lg rounded-lg shadow">
                    </div>
                @endif
                @if(!auth()->user()->is_admin && $payment->status === 'pending')
                    <div class="sm:col-span-2 mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Upload Proof of Payment</h3>
                        <form action="{{ route('subscription.confirm-payment') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                            
                            <div>
                                <label for="proof_of_payment" class="block text-sm font-medium text-gray-700">
                                    Payment Screenshot/Image
                                </label>
                                <p class="mt-1 text-sm text-gray-500">Upload a clear image of your payment confirmation (PNG, JPG up to 2MB)</p>
                                <input type="file" 
                                       name="proof_of_payment" 
                                       id="proof_of_payment" 
                                       accept="image/*"
                                       required
                                       class="mt-2 block w-full text-sm text-gray-600
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-md file:border-0
                                              file:text-sm file:font-medium
                                              file:bg-blue-50 file:text-blue-700
                                              hover:file:bg-blue-100">
                            </div>

                            <div>
                                <button type="submit" 
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm 
                                               text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 
                                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Submit Payment Proof
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                @if(auth()->user()->is_admin && $payment->status === 'pending')
                    <div class="sm:col-span-2 mt-6">
                        <form action="{{ route('subscription.verify-payment', $payment) }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Update Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="approved">Approve</option>
                                        <option value="rejected">Reject</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Admin Notes</label>
                                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                                </div>

                                <div>
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Update Payment Status
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
