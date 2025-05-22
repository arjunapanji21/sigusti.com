@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">User Details</h2>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('users.index') }}" class="text-blue-600 hover:text-blue-800">
                            Back to List
                        </a>
                    @endif
                </div>
            </div>
            
            <div class="p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->name }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Joined</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</dd>
                    </div>
                    
                    @if($user->subscription)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Subscription Status</dt>
                            <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $user->subscription->status }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Current Plan</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->subscription->plan->name }}</dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Expires</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $user->subscription->expires_at->format('M d, Y') }}</dd>
                        </div>
                    @endif
                </dl>

                @if($user->license)
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900">License Information</h3>
                        <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">License Key</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $user->license->key }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1 text-sm text-gray-900 capitalize">{{ $user->license->status }}</dd>
                            </div>
                            
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Last Activity</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $user->license->last_activity_at ? $user->license->last_activity_at->format('M d, Y H:i:s') : 'Never' }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
