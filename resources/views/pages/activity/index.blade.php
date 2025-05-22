@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Activity History</h2>
            </div>
            
            <div class="bg-white divide-y divide-gray-200">
                @forelse($activities as $activity)
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">
                                    License: {{ $activity->license->key }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $activity->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="ml-4">
                                <a href="{{ route('activities.show', $activity) }}" class="text-blue-600 hover:text-blue-800">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        No activities found.
                    </div>
                @endforelse
            </div>

            @if($activities->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $activities->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
