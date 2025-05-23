<x-app-layout>
    <!-- Page Header -->
    <div class="">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Plans Management</h2>
                    <p class="mt-1 text-sm text-gray-500">Manage your subscription plans and pricing</p>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <a href="{{ route('plans.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Plan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Status Counts -->
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Plans</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $plans->count() }}</dd>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Active Plans</dt>
                    <dd class="mt-1 text-3xl font-semibold text-green-600">{{ $plans->where('is_active', true)->count() }}</dd>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">Plans On Sale</dt>
                    <dd class="mt-1 text-3xl font-semibold text-red-600">{{ $plans->filter->isOnSale()->count() }}</dd>
                </div>
            </div>
        </dl>

        <!-- Plans Table -->
        <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hiddenmd:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Regular Price</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Sale Price</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Duration</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Daily Limit</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Monthly Limit</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Max Devices</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($plans as $plan)
                                    <tr>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $plan->name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <span class="{{ $plan->isOnSale() ? 'line-through text-gray-400' : '' }}">
                                                Rp. {{ number_format($plan->price) }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                                            @if($plan->isOnSale())
                                                <span class="text-green-600 font-medium">Rp. {{ number_format($plan->sale_price) }}</span>
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $plan->isOnSale() ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                    {{ $plan->discount_badge }}
                                                </span>
                                                @if($plan->sale_ends_at)
                                                    <span class="block text-xs text-gray-500">Ends {{ $plan->sale_ends_at->diffForHumans() }}</span>
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $plan->duration_days }} hari</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ number_format($plan->daily_limit) }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ number_format($plan->monthly_limit) }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $plan->max_device }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ $plan->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="{{ route('plans.edit', $plan) }}" class="text-green-600 hover:text-green-900 mr-4">Edit</a>
                                            <form action="{{ route('plans.destroy', $plan) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Confirmation Modal -->
    <div id="confirmModal" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-modal="true">
        <!-- Add modal implementation here -->
    </div>

    <script>
        function confirmDelete(event) {
            event.preventDefault();
            // Add delete confirmation logic
        }
    </script>
</x-app-layout>
