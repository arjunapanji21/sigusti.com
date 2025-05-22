@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Activity Details</h2>
                    <a href="{{ route('activities.index') }}" class="text-blue-600 hover:text-blue-800">
                        Back to List
                    </a>
                </div>
            </div>
            
            <div class="p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">License Key</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $activity->license->key }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">User</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $activity->license->user->name }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Timestamp</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $activity->created_at }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">IP Address</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $activity->ip_address }}</dd>
                    </div>
                    
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Details</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $activity->details }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
