<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ auth()->user()->can('admin-actions') ? 'Payment Management' : 'My Payments' }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ auth()->user()->can('admin-actions') ? 'Monitor and manage all payments' : 'View your payment history' }}
                </p>
            </div>
        </div>

        <!-- Payment List -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            @can('admin-actions')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            @endcan
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($payments as $payment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    #{{ $payment->id }}
                                </td>
                                @can('admin-actions')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-green-600 flex items-center justify-center">
                                                <span class="text-white text-sm font-medium">{{ substr($payment->user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $payment->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $payment->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                @endcan
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $payment->plan->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $payment->payment_frequency == 'yearly' ? $payment->plan->duration_days * 12 : $payment->plan->duration_days }} days</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp. {{ number_format($payment->amount) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $payment->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                           ($payment->status === 'pending_payment' ? 'bg-yellow-100 text-yellow-800' : 
                                            ($payment->status === 'pending_approval' ? 'bg-blue-100 text-blue-800' : 
                                             'bg-red-100 text-red-800')) }}">
                                        {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $payment->created_at->format('M d, Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('payments.show', $payment) }}" class="text-green-600 hover:text-green-900">View</a>
                                    @if(auth()->user()->can('admin-actions') && $payment->status !== 'approved')
                                        <form action="{{ route('payments.approve', $payment) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="cursor-pointer text-green-600 hover:text-green-900">Approve</button>
                                        </form>
                                        <form action="{{ route('payments.reject', $payment) }}" method="POST" class="inline-block ml-2">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="cursor-pointer text-red-600 hover:text-red-900">Reject</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if($payments->isEmpty())
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No payments found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            @if($payments->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $payments->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
