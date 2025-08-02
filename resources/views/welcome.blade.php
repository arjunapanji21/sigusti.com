<x-guest-layout>
    <div class="py-12 bg-gradient-to-br from-green-50 via-green-100 to-green-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl mb-8 border-t-4 border-green-500">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h1 class="text-3xl font-bold text-gray-900">Selamat Datang di SI-GUSTI!</h1>
                            </div>
                            <p class="text-lg text-gray-700 leading-relaxed">
                                <span class="font-semibold text-green-600">Sistem Informasi Growth Up Stimulation</span> - 
                                Platform terpadu untuk memantau dan merangsang tumbuh kembang balita secara optimal dengan pendekatan ilmiah dan mudah digunakan.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    🌱 Monitoring Pertumbuhan
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    🧠 Stimulasi Perkembangan
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    📊 Laporan Komprehensif
                                </span>
                            </div>
                        </div>
                        <div class="mt-6 md:mt-0 md:ml-6">
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-lg text-base font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform hover:scale-105 transition-all duration-200">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                                    </svg>
                                    Buka Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-lg text-base font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform hover:scale-105 transition-all duration-200">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                    Mulai Sekarang
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Feature Overview -->
            <div id="features" class="bg-white overflow-hidden shadow-xl sm:rounded-2xl mb-8">
                <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-green-500 to-green-600">
                    <h3 class="text-xl font-bold leading-6 text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Fitur Unggulan SI-GUSTI
                    </h3>
                    <p class="mt-1 text-green-50">Semua yang Anda butuhkan untuk mendukung tumbuh kembang balita</p>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="flex group hover:bg-green-50 p-4 rounded-lg transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                                    <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-semibold text-gray-900">Monitoring Pertumbuhan</h4>
                                <p class="mt-1 text-sm text-gray-600">Pantau berat badan, tinggi badan, dan lingkar kepala balita secara berkala dengan grafik pertumbuhan WHO.</p>
                            </div>
                        </div>

                        <div class="flex group hover:bg-green-50 p-4 rounded-lg transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                                    <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-semibold text-gray-900">Stimulasi Perkembangan</h4>
                                <p class="mt-1 text-sm text-gray-600">Program aktivitas stimulasi sesuai usia untuk mengoptimalkan perkembangan motorik, kognitif, dan sosial.</p>
                            </div>
                        </div>

                        <div class="flex group hover:bg-green-50 p-4 rounded-lg transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                                    <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2h8a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 1a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-semibold text-gray-900">Asesmen KPSP</h4>
                                <p class="mt-1 text-sm text-gray-600">Kuisioner Pra Skrining Perkembangan untuk deteksi dini keterlambatan perkembangan balita.</p>
                            </div>
                        </div>

                        <div class="flex group hover:bg-green-50 p-4 rounded-lg transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                                    <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-semibold text-gray-900">Laporan Komprehensif</h4>
                                <p class="mt-1 text-sm text-gray-600">Laporan berkala progress tumbuh kembang balita dalam format yang mudah dipahami.</p>
                            </div>
                        </div>

                        <div class="flex group hover:bg-green-50 p-4 rounded-lg transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                                    <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-semibold text-gray-900">Reminder & Notifikasi</h4>
                                <p class="mt-1 text-sm text-gray-600">Pengingat jadwal imunisasi, kontrol kesehatan, dan aktivitas stimulasi harian.</p>
                            </div>
                        </div>

                        <div class="flex group hover:bg-green-50 p-4 rounded-lg transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                                    <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-base font-semibold text-gray-900">Multi User</h4>
                                <p class="mt-1 text-sm text-gray-600">Akses untuk orangtua, pengasuh, dan tenaga kesehatan dengan role yang berbeda.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Get Started -->
            <div id="getting-started" class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">
                <div class="px-8 py-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold leading-6 text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                        </svg>
                        Mulai Perjalanan Tumbuh Kembang Balita
                    </h3>
                </div>
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-8 items-center">
                        <div>
                            <p class="text-gray-700 mb-6 text-lg leading-relaxed">
                                Bergabunglah dengan ribuan orangtua yang telah mempercayakan monitoring tumbuh kembang balita mereka dengan SI-GUSTI. 
                                <span class="font-semibold text-green-600">Daftar sekarang</span> dan dapatkan akses penuh ke semua fitur.
                            </p>
                            <div class="grid grid-cols-3 gap-4 mb-6">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-600">1000+</div>
                                    <div class="text-sm text-gray-500">Keluarga</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-600">5000+</div>
                                    <div class="text-sm text-gray-500">Balita Terpantau</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-600">98%</div>
                                    <div class="text-sm text-gray-500">Kepuasan</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-lg text-base font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform hover:scale-105 transition-all duration-200">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                    </svg>
                                    Buka Dashboard Saya
                                </a>
                                <a href="#features" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                    Pelajari Fitur Lainnya
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-lg text-base font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform hover:scale-105 transition-all duration-200">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    Daftar Gratis Sekarang
                                </a>
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Sudah Punya Akun? Masuk
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
