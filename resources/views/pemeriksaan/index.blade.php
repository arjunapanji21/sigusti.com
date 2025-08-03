<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Pemeriksaan Balita</h1>
                            <p class="mt-1 text-sm text-gray-600">
                                Kelola dan pantau hasil pemeriksaan tumbuh kembang balita
                            </p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <a href="{{ route('pemeriksaan.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Pemeriksaan Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Pemeriksaan</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $pemeriksaan->total() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Normal</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $pemeriksaan->where('kode_pertumbuhan', 'normal')->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Perlu Perhatian</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $pemeriksaan->whereIn('kode_pertumbuhan', ['kurang', 'sangat_kurang', 'lebih'])->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Bulan Ini</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $pemeriksaan->where('created_at', '>=', now()->startOfMonth())->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pemeriksaan List -->
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Riwayat Pemeriksaan</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Daftar pemeriksaan yang telah dilakukan</p>
                </div>
                
                @if($pemeriksaan->count() > 0)
                    <ul class="divide-y divide-gray-200">
                        @foreach($pemeriksaan as $item)
                        <li>
                            <a href="{{ route('pemeriksaan.show', $item->id) }}" class="block hover:bg-gray-50">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                @if($item->kode_pertumbuhan == 'normal')
                                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="flex items-center">
                                                    <p class="text-sm font-medium text-gray-900">{{ $item->nama_balita }}</p>
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                        @if($item->kode_pertumbuhan == 'normal') bg-green-100 text-green-800
                                                        @elseif($item->kode_pertumbuhan == 'kurang') bg-yellow-100 text-yellow-800
                                                        @elseif($item->kode_pertumbuhan == 'sangat_kurang') bg-red-100 text-red-800
                                                        @elseif($item->kode_pertumbuhan == 'lebih') bg-orange-100 text-orange-800
                                                        @endif">
                                                        {{ ucfirst(str_replace('_', ' ', $item->kode_pertumbuhan)) }}
                                                    </span>
                                                    @if(auth()->user()->isAdmin() && $item->user)
                                                        <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                            {{ $item->user->name }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="mt-1 flex items-center text-sm text-gray-500">
                                                    <p>{{ $item->usia_saat_pemeriksaan }} bulan • {{ $item->gender == 'L' ? 'Laki-laki' : 'Perempuan' }} • {{ $item->berat }} kg</p>
                                                    <span class="mx-2">•</span>
                                                    <p>{{ $item->created_at->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <!-- Enhanced Pagination -->
                    @if($pemeriksaan->hasPages())
                    <div class="bg-white px-6 py-4 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
                            <!-- Results Info -->
                            <div class="flex items-center text-sm text-gray-700">
                                <span class="font-medium">{{ $pemeriksaan->firstItem() }}</span>
                                <span class="mx-1">-</span>
                                <span class="font-medium">{{ $pemeriksaan->lastItem() }}</span>
                                <span class="mx-1">dari</span>
                                <span class="font-medium">{{ $pemeriksaan->total() }}</span>
                                <span class="ml-1">hasil</span>
                            </div>
                            
                            <!-- Pagination Links -->
                            <div class="flex items-center space-x-1">
                                {{-- Previous Page Link --}}
                                @if ($pemeriksaan->onFirstPage())
                                    <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-l-md cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1">Prev</span>
                                    </span>
                                @else
                                    <a href="{{ $pemeriksaan->previousPageUrl() }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1">Prev</span>
                                    </a>
                                @endif

                                {{-- Pagination Elements with Intervals --}}
                                @php
                                    $currentPage = $pemeriksaan->currentPage();
                                    $lastPage = $pemeriksaan->lastPage();
                                    $start = max(1, $currentPage - 2);
                                    $end = min($lastPage, $currentPage + 2);
                                @endphp

                                {{-- First Page --}}
                                @if($start > 1)
                                    <a href="{{ $pemeriksaan->url(1) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
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
                                        <a href="{{ $pemeriksaan->url($i) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
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
                                    <a href="{{ $pemeriksaan->url($lastPage) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
                                        {{ $lastPage }}
                                    </a>
                                @endif

                                {{-- Next Page Link --}}
                                @if ($pemeriksaan->hasMorePages())
                                    <a href="{{ $pemeriksaan->nextPageUrl() }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
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
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pemeriksaan</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat pemeriksaan pertama untuk balita Anda.</p>
                        <div class="mt-6">
                            <a href="{{ route('pemeriksaan.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Buat Pemeriksaan Baru
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
