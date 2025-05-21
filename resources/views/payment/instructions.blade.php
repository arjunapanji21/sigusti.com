<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6">Payment Instructions</h2>
        
        <div class="space-y-6">
            <div class="border-b pb-4">
                <p class="font-medium">Amount to Pay: ${{ $plan->price }}</p>
                <p class="text-gray-600">Reference Number: {{ $payment->reference_number }}</p>
            </div>

            <div class="space-y-4">
                <h3 class="font-medium">Bank Transfer Details:</h3>
                <div class="bg-gray-50 p-4 rounded">
                    <p>Bank Name: Your Bank Name</p>
                    <p>Account Number: 1234-5678-9012</p>
                    <p>Account Name: Your Company Name</p>
                </div>

                <h3 class="font-medium">E-Wallet Details:</h3>
                <div class="bg-gray-50 p-4 rounded">
                    <p>GCash/PayMaya Number: +63 912 345 6789</p>
                    <p>Account Name: Your Company Name</p>
                </div>
            </div>

            <form action="{{ route('subscription.confirm-payment') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                
                <div>
                    <label class="block mb-2">Upload Proof of Payment:</label>
                    <input type="file" name="proof_of_payment" accept="image/*" required
                           class="w-full border border-gray-300 rounded p-2">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                    Submit Payment Proof
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
