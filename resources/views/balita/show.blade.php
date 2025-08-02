<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <a href="{{ route('balita.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                            </a>
                            <div class="flex items-center">
                                <div class="w-16 h-16 {{ $balitum->gender == 'P' ? 'bg-pink-100' : 'bg-blue-100' }} rounded-full flex items-center justify-center mr-4">
                                    @if($balitum->gender == 'P')
                                        <svg class="w-8 h-8 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a4 4 0 100 8 4 4 0 000-8zM4 14a6 6 0 1112 0v1a1 1 0 01-1 1H5a1 1 0 01-1-1v-1z"/>
                                        </svg>
                                    @else
                                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a4 4 0 100 8 4 4 0 000-8zM4 14a6 6 0 1112 0v1a1 1 0 01-1 1H5a1 1 0 01-1-1v-1z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $balitum->name }}</h1>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ $balitum->gender == 'P' ? 'Perempuan' : 'Laki-laki' }} • 
                                        @php
                                            $ageInYears = floor($balitum->usia_bulan / 12);
                                            $remainingMonths = $balitum->usia_bulan % 12;
                                        @endphp
                                        @if($ageInYears > 0)
                                            {{ $ageInYears }} tahun 
                                        @endif
                                        {{ $remainingMonths }} bulan
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('balita.edit', $balitum) }}" 
                               class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Balita -->
            <div class="bg-white shadow sm:rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Informasi Balita</h3>
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $balitum->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $balitum->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $balitum->tgl_lahir->format('d F Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Usia</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($ageInYears > 0)
                                    {{ $ageInYears }} tahun 
                                @endif
                                {{ $remainingMonths }} bulan ({{ $balitum->usia_bulan }} bulan)
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Ibu</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $balitum->ibu }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Wilayah</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $balitum->wilayah->name ?? 'Tidak diketahui' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <a href="{{ route('pemeriksaan.create') }}?balita={{ $balitum->id }}" 
                           class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-sm font-medium text-gray-900">Pemeriksaan Baru</p>
                                <p class="text-sm text-gray-500">Lakukan pemeriksaan KPSP</p>
                            </div>
                        </a>

                        <a href="#" 
                           class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-sm font-medium text-gray-900">Grafik Perkembangan</p>
                                <p class="text-sm text-gray-500">Lihat grafik tumbuh kembang</p>
                            </div>
                        </a>

                        <a href="#" 
                           class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-sm font-medium text-gray-900">Riwayat Pemeriksaan</p>
                                <p class="text-sm text-gray-500">Lihat riwayat pemeriksaan</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
