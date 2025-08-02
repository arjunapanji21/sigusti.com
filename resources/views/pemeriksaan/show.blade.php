<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <a href="{{ route('pemeriksaan.index') }}" class="mr-4 text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                            </a>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">Detail Pemeriksaan</h1>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ $pemeriksaan->nama_balita }} • {{ $pemeriksaan->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('pemeriksaan.print', $pemeriksaan->id) }}" 
                               target="_blank"
                               class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                </svg>
                                Cetak
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Screen Display Content -->
            <div>
                <!-- Data Balita -->
                <div class="bg-white shadow sm:rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Data Balita</h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nama Balita</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $pemeriksaan->nama_balita }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $pemeriksaan->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Usia Saat Pemeriksaan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $pemeriksaan->usia_saat_pemeriksaan }} bulan</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Berat Badan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $pemeriksaan->berat }} kg</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Hasil Pemeriksaan -->
                <div class="bg-white shadow sm:rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Hasil Pemeriksaan</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Status Pertumbuhan -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    @if($pemeriksaan->kode_pertumbuhan == 'normal')
                                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900">Status Pertumbuhan</h4>
                                        <p class="text-sm 
                                            @if($pemeriksaan->kode_pertumbuhan == 'normal') text-green-600
                                            @elseif($pemeriksaan->kode_pertumbuhan == 'kurang') text-yellow-600
                                            @elseif($pemeriksaan->kode_pertumbuhan == 'sangat_kurang') text-red-600
                                            @elseif($pemeriksaan->kode_pertumbuhan == 'lebih') text-orange-600
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $pemeriksaan->kode_pertumbuhan)) }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Perkembangan -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center">
                                    @if($pemeriksaan->kode_tindakan_perkembangan == 'sesuai')
                                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    @elseif($pemeriksaan->kode_tindakan_perkembangan == 'meragukan')
                                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900">Status Perkembangan</h4>
                                        <p class="text-sm 
                                            @if($pemeriksaan->kode_tindakan_perkembangan == 'sesuai') text-green-600
                                            @elseif($pemeriksaan->kode_tindakan_perkembangan == 'meragukan') text-yellow-600
                                            @else text-red-600
                                            @endif">
                                            {{ ucfirst($pemeriksaan->kode_tindakan_perkembangan) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Kontrol -->
                <div class="bg-white shadow sm:rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Jadwal Kontrol Selanjutnya</h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Jadwal Pertumbuhan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($pemeriksaan->jadwal_pertumbuhan)->format('d M Y') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Jadwal Perkembangan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($pemeriksaan->jadwal_perkembangan)->format('d M Y') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Rekomendasi -->
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Rekomendasi Tindakan</h3>
                        <div class="space-y-6">
                            @if(isset($recommendations['pertumbuhan']))
                            <!-- Rekomendasi Pertumbuhan -->
                            <div class="border-l-4 @if($recommendations['pertumbuhan']['status'] == 'success') border-green-400 bg-green-50 @elseif($recommendations['pertumbuhan']['status'] == 'warning') border-yellow-400 bg-yellow-50 @else border-red-400 bg-red-50 @endif p-4 rounded-r-lg">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        @if($recommendations['pertumbuhan']['status'] == 'success')
                                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        @elseif($recommendations['pertumbuhan']['status'] == 'warning')
                                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        @else
                                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <h4 class="text-sm font-medium @if($recommendations['pertumbuhan']['status'] == 'success') text-green-800 @elseif($recommendations['pertumbuhan']['status'] == 'warning') text-yellow-800 @else text-red-800 @endif">
                                            {{ $recommendations['pertumbuhan']['title'] }}
                                        </h4>
                                        <p class="mt-1 text-sm @if($recommendations['pertumbuhan']['status'] == 'success') text-green-700 @elseif($recommendations['pertumbuhan']['status'] == 'warning') text-yellow-700 @else text-red-700 @endif">
                                            {{ $recommendations['pertumbuhan']['description'] }}
                                        </p>
                                        <ul class="mt-3 list-disc list-inside text-sm @if($recommendations['pertumbuhan']['status'] == 'success') text-green-700 @elseif($recommendations['pertumbuhan']['status'] == 'warning') text-yellow-700 @else text-red-700 @endif space-y-1">
                                            @foreach($recommendations['pertumbuhan']['actions'] as $action)
                                            <li>{{ $action }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(isset($recommendations['perkembangan']))
                            <!-- Rekomendasi Perkembangan -->
                            <div class="border-l-4 @if($recommendations['perkembangan']['status'] == 'success') border-green-400 bg-green-50 @elseif($recommendations['perkembangan']['status'] == 'warning') border-yellow-400 bg-yellow-50 @else border-red-400 bg-red-50 @endif p-4 rounded-r-lg">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        @if($recommendations['perkembangan']['status'] == 'success')
                                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        @elseif($recommendations['perkembangan']['status'] == 'warning')
                                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        @else
                                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <h4 class="text-sm font-medium @if($recommendations['perkembangan']['status'] == 'success') text-green-800 @elseif($recommendations['perkembangan']['status'] == 'warning') text-yellow-800 @else text-red-800 @endif">
                                            {{ $recommendations['perkembangan']['title'] }}
                                        </h4>
                                        <p class="mt-1 text-sm @if($recommendations['perkembangan']['status'] == 'success') text-green-700 @elseif($recommendations['perkembangan']['status'] == 'warning') text-yellow-700 @else text-red-700 @endif">
                                            {{ $recommendations['perkembangan']['description'] }}
                                        </p>
                                        <ul class="mt-3 list-disc list-inside text-sm @if($recommendations['perkembangan']['status'] == 'success') text-green-700 @elseif($recommendations['perkembangan']['status'] == 'warning') text-yellow-700 @else text-red-700 @endif space-y-1">
                                            @foreach($recommendations['perkembangan']['actions'] as $action)
                                            <li>{{ $action }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
