@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4 border-b border-gray-200 space-y-4">
                <!-- Search Form -->
                <form action="{{ route('users.index') }}" method="GET" class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            class="w-full p-2 rounded-md bg-gray-50 border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                            placeholder="Search by name, email or phone...">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Search Results Info -->
                @if(request('search'))
                    <div class="text-sm text-gray-500">
                        Found {{ $users->total() }} results for "{{ request('search') }}"
                    </div>
                @endif
            </div>
            
            <div class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                    <div class="p-6 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-xl font-medium text-gray-600">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">{{ $user->name }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ $user->email }}</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ ucfirst($user->role ?? 'user') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-500">
                                    Joined {{ $user->created_at->format('M d, Y') }}
                                </span>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('users.show', $user) }}" class="px-3 py-1 text-sm text-green-600 hover:text-green-800 hover:bg-green-50 rounded">
                                        View
                                    </a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded" 
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
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
                    {{ $users->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
