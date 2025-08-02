<x-app-layout>
    <!-- Mobile App Layout -->
    <div class="min-h-screen bg-gray-50">
        <!-- Header Card -->
        <div class="bg-white shadow-sm">
            <div class="px-4 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">Halo, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
                        <p class="text-sm text-gray-600">Monitor tumbuh kembang si kecil</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                        <p class="text-xs text-gray-400">{{ now()->format('H:i') }} WIB</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="px-4 py-6 space-y-6">
            <!-- Quick Actions Grid -->
            <div class="bg-white rounded-xl shadow-sm p-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Menu Utama</h2>
                <div class="grid grid-cols-3 gap-4">
                    <a href="#" class="flex flex-col items-center p-3 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Balita</span>
                    </a>
                    
                    <a href="#" class="flex flex-col items-center p-3 rounded-lg bg-green-50 hover:bg-green-100 transition-colors">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Pemeriksaan</span>
                    </a>
                    
                    <a href="#" class="flex flex-col items-center p-3 rounded-lg bg-purple-50 hover:bg-purple-100 transition-colors">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Perkembangan</span>
                    </a>
                    
                    <a href="#" class="flex flex-col items-center p-3 rounded-lg bg-yellow-50 hover:bg-yellow-100 transition-colors">
                        <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Riwayat</span>
                    </a>
                    
                    <a href="#" class="flex flex-col items-center p-3 rounded-lg bg-red-50 hover:bg-red-100 transition-colors">
                        <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Video Materi</span>
                    </a>
                    
                    <a href="{{ url('/settings') }}" class="flex flex-col items-center p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                        <div class="w-12 h-12 bg-gray-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Pengaturan</span>
                    </a>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="bg-white rounded-xl shadow-sm p-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Data</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm">Total Balita</p>
                                <p class="text-2xl font-bold">5</p>
                            </div>
                            <svg class="w-8 h-8 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-100 text-sm">Gizi Baik</p>
                                <p class="text-2xl font-bold">4</p>
                            </div>
                            <svg class="w-8 h-8 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-100 text-sm">Pengukuran</p>
                                <p class="text-2xl font-bold">25</p>
                            </div>
                            <svg class="w-8 h-8 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-4 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-yellow-100 text-sm">Imunisasi</p>
                                <p class="text-2xl font-bold">18</p>
                            </div>
                            <svg class="w-8 h-8 text-yellow-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Children Profiles -->
            <div class="bg-white rounded-xl shadow-sm p-4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Data Balita Terbaru</h2>
                    <a href="#" class="text-green-600 text-sm font-medium">Lihat Semua</a>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-pink-500 rounded-lg flex items-center justify-center mr-3">
                                <span class="text-white font-semibold text-sm">AS</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Aisyah Sari</p>
                                <p class="text-sm text-gray-500">2 tahun 3 bulan • Gizi Baik</p>
                            </div>
                        </div>
                        <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                <span class="text-white font-semibold text-sm">RF</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Rafif Ahmad</p>
                                <p class="text-sm text-gray-500">1 tahun 8 bulan • Perlu Perhatian</p>
                            </div>
                        </div>
                        <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                                <span class="text-white font-semibold text-sm">ZH</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Zahra Hani</p>
                                <p class="text-sm text-gray-500">3 tahun 1 bulan • Gizi Baik</p>
                            </div>
                        </div>
                        <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
