@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">User Management</h2>
            </div>
            
            <div class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $user->name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-500">
                                    Joined {{ $user->created_at->format('M d, Y') }}
                                </span>
                                <a href="{{ route('users.show', $user) }}" class="text-blue-600 hover:text-blue-800">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        No users found.
                    </div>
                @endforelse
            </div>

            @if($users->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
