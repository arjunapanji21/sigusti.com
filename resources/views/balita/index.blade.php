<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Data Balita</h1>
                            <p class="mt-1 text-sm text-gray-600">
                                Kelola data balita yang terdaftar dalam sistem
                            </p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            <a href="{{ route('balita.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Balita
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
                                <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Balita</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $balita->total() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-pink-500 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Perempuan</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $balita->where('gender', 'P')->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-600 rounded-md flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Laki-laki</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $balita->where('gender', 'L')->count() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

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
                                    <dt class="text-sm font-medium text-gray-500 truncate">Aktif</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $balita->total() }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Balita List -->
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Daftar Balita</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Data balita yang terdaftar</p>
                </div>
                
                @if($balita->count() > 0)
                    <ul class="divide-y divide-gray-200">
                        @foreach($balita as $item)
                        @php
                            $birthDate = \Carbon\Carbon::parse($item->tgl_lahir);
                            $ageInMonths = $birthDate->diffInMonths(\Carbon\Carbon::now());
                            $ageInYears = floor($ageInMonths / 12);
                            $remainingMonths = $ageInMonths % 12;
                        @endphp
                        <li>
                            <a href="{{ route('balita.show', $item->id) }}" class="block hover:bg-gray-50">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 {{ $item->gender == 'P' ? 'bg-pink-100' : 'bg-blue-100' }} rounded-full flex items-center justify-center">
                                                    @if($item->gender == 'P')
                                                        <svg class="w-6 h-6 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 2a4 4 0 100 8 4 4 0 000-8zM4 14a6 6 0 1112 0v1a1 1 0 01-1 1H5a1 1 0 01-1-1v-1z"/>
                                                        </svg>
                                                    @else
                                                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 2a4 4 0 100 8 4 4 0 000-8zM4 14a6 6 0 1112 0v1a1 1 0 01-1 1H5a1 1 0 01-1-1v-1z"/>
                                                        </svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="flex items-center">
                                                    <p class="text-sm font-medium text-gray-900">{{ $item->name }}</p>
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                        {{ $item->gender == 'P' ? 'bg-pink-100 text-pink-800' : 'bg-blue-100 text-blue-800' }}">
                                                        {{ $item->gender == 'P' ? 'Perempuan' : 'Laki-laki' }}
                                                    </span>
                                                    @if(auth()->user()->isAdmin() && $item->user)
                                                        <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                            {{ $item->user->name }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="mt-1 flex items-center text-sm text-gray-500">
                                                    <p>Ibu: {{ $item->ibu }}</p>
                                                    <span class="mx-2">•</span>
                                                    <p>
                                                        @if($ageInYears > 0)
                                                            {{ $ageInYears }} tahun 
                                                        @endif
                                                        {{ $remainingMonths }} bulan
                                                    </p>
                                                    <span class="mx-2">•</span>
                                                    <p>{{ $item->tgl_lahir->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            @if(!auth()->user()->isAdmin() || $item->user_id == auth()->id())
                                                <a href="{{ route('balita.edit', $item->id) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>
                                            @endif
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
                    @if($balita->hasPages())
                    <div class="bg-white px-6 py-4 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
                            <!-- Results Info -->
                            <div class="flex items-center text-sm text-gray-700">
                                <span class="font-medium">{{ $balita->firstItem() }}</span>
                                <span class="mx-1">-</span>
                                <span class="font-medium">{{ $balita->lastItem() }}</span>
                                <span class="mx-1">dari</span>
                                <span class="font-medium">{{ $balita->total() }}</span>
                                <span class="ml-1">hasil</span>
                            </div>
                            
                            <!-- Pagination Links -->
                            <div class="flex items-center space-x-1">
                                {{-- Previous Page Link --}}
                                @if ($balita->onFirstPage())
                                    <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-l-md cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1">Prev</span>
                                    </span>
                                @else
                                    <a href="{{ $balita->previousPageUrl() }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1">Prev</span>
                                    </a>
                                @endif

                                {{-- Pagination Elements with Intervals --}}
                                @php
                                    $currentPage = $balita->currentPage();
                                    $lastPage = $balita->lastPage();
                                    $start = max(1, $currentPage - 2);
                                    $end = min($lastPage, $currentPage + 2);
                                @endphp

                                {{-- First Page --}}
                                @if($start > 1)
                                    <a href="{{ $balita->url(1) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
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
                                        <a href="{{ $balita->url($i) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
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
                                    <a href="{{ $balita->url($lastPage) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
                                        {{ $lastPage }}
                                    </a>
                                @endif

                                {{-- Next Page Link --}}
                                @if ($balita->hasMorePages())
                                    <a href="{{ $balita->nextPageUrl() }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 hover:text-green-600 transition-colors duration-200">
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada data balita</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan data balita pertama.</p>
                        <div class="mt-6">
                            <a href="{{ route('balita.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Balita Baru
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
