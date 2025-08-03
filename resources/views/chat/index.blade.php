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
        @if(!auth()->user()->isAdmin())
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

            <!-- Enhanced Pagination with Intervals -->
            @if($conversations->hasPages())
            <div class="bg-white px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
                    <!-- Results Info -->
                    <div class="flex items-center text-sm text-gray-700">
                        <span class="font-medium">{{ $conversations->firstItem() }}</span>
                        <span class="mx-1">-</span>
                        <span class="font-medium">{{ $conversations->lastItem() }}</span>
                        <span class="mx-1">dari</span>
                        <span class="font-medium">{{ $conversations->total() }}</span>
                        <span class="ml-1">percakapan</span>
                    </div>
                    
                    <!-- Pagination Links -->
                    <div class="flex items-center space-x-1">
                        {{-- Previous Page Link --}}
                        @if ($conversations->onFirstPage())
                            <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-l-md cursor-not-allowed">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-1">Prev</span>
                            </span>
                        @else
                            <a href="{{ $conversations->previousPageUrl() }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-1">Prev</span>
                            </a>
                        @endif

                        {{-- Pagination Elements with Intervals --}}
                        @php
                            $currentPage = $conversations->currentPage();
                            $lastPage = $conversations->lastPage();
                            $start = max(1, $currentPage - 2);
                            $end = min($lastPage, $currentPage + 2);
                        @endphp

                        {{-- First Page --}}
                        @if($start > 1)
                            <a href="{{ $conversations->url(1) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
                                1
                            </a>
                            @if($start > 2)
                                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300">
                                    ...
                                </span>
                            @endif
                        @endif

                        {{-- Page Numbers Around Current Page --}}
                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $currentPage)
                                <span class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-green-500 to-green-600 border border-green-500 shadow-sm">
                                    {{ $i }}
                                </span>
                            @else
                                <a href="{{ $conversations->url($i) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
                                    {{ $i }}
                                </a>
                            @endif
                        @endfor

                        {{-- Last Page --}}
                        @if($end < $lastPage)
                            @if($end < $lastPage - 1)
                                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300">
                                    ...
                                </span>
                            @endif
                            <a href="{{ $conversations->url($lastPage) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
                                {{ $lastPage }}
                            </a>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($conversations->hasMorePages())
                            <a href="{{ $conversations->nextPageUrl() }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
                                <span class="mr-1">Next</span>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-r-md cursor-not-allowed">
                                <span class="mr-1">Next</span>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        @else
            <div class="text-center py-12">
                <p class="text-gray-500">
                    {{ auth()->user()->isAdmin() ? 'Menunggu pesan dari masyarakat' : 'Mulai percakapan dengan admin puskesmas' }}
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
