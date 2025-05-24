<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ auth()->user()->can('admin-actions') ? 'License Management' : 'My Licenses' }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ auth()->user()->can('admin-actions') ? 'Manage and monitor all licenses' : 'View and manage your licenses' }}
                </p>
            </div>
            <a href="{{ route('payments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Get New License
            </a>
        </div>

        <!-- License List -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            @can('admin-actions')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            @endcan
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">License Key</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usage</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expires</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($licenses as $license)
                            <tr>
                                @can('admin-actions')
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img class="h-8 w-8 rounded-full" src="{{ $license->user->profile_photo_url }}" alt="">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $license->user->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                @endcan
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p id="license-{{ $license->id }}" class="font-mono text-sm pr-12">
                                        <span class="license-key">{{ Str::limit($license->license_key, 10) }}</span>
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $license->plan->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $license->isValid() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $license->isValid() ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        Daily: {{ $license->daily_usage }}/{{ $license->daily_limit }}
                                        <div class="w-24 h-1.5 bg-gray-200 rounded-full">
                                            <div class="h-1.5 bg-green-500 rounded-full" style="width: {{ min(($license->daily_usage / $license->daily_limit) * 100, 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $license->expires_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('licenses.show', $license) }}" class="text-green-600 hover:text-green-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                        @if($licenses->isEmpty())
                            <tr>
                                <td colspan="{{ auth()->user()->can('admin-actions') ? 7 : 6 }}" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No licenses found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
