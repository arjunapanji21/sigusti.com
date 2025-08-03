@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                {{ auth()->user()->role == 'admin' ? 'Inbox Puskesmas' : 'Pesan' }}
            </h1>
            <p class="mt-2 text-sm text-gray-700">
                {{ auth()->user()->role == 'admin' ? 'Kelola pesan dari masyarakat' : 'Komunikasi dengan admin puskesmas' }}
            </p>
        </div>
        @if(!auth()->user()->is_admin)
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('chat.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Pesan Baru
                </a>
            </div>
        @endif
    </div>

    <!-- Chat List -->
    <div class="bg-white shadow rounded-lg">
        @if($conversations->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($conversations as $conversation)
                    <a href="{{ route('chat.show', $conversation['user']->id) }}" class="block hover:bg-gray-50 transition-colors">
                        <div class="px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <span class="text-green-800 font-medium text-sm">
                                                {{ strtoupper(substr($conversation['user']->name, 0, 2)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center space-x-2">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                {{ $conversation['user']->name }}
                                            </p>
                                            @if(auth()->user()->is_admin)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                    Masyarakat
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                    Admin
                                                </span>
                                            @endif
                                        </div>
                                        @if($conversation['last_message'])
                                            <p class="text-sm text-gray-500 truncate">
                                                {{ Str::limit($conversation['last_message'], 60) }}
                                            </p>
                                        @else
                                            <p class="text-sm text-gray-400 italic">Belum ada pesan</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex flex-col items-end space-y-1">
                                    @if($conversation['last_message_time'])
                                        <span class="text-xs text-gray-500">
                                            {{ $conversation['last_message_time']->diffForHumans() }}
                                        </span>
                                    @endif
                                    @if($conversation['unread_count'] > 0)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ $conversation['unread_count'] }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada percakapan</h3>
                <p class="mt-1 text-sm text-gray-500">
                    {{ auth()->user()->is_admin ? 'Menunggu pesan dari masyarakat' : 'Mulai percakapan dengan admin puskesmas' }}
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
