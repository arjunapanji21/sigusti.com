<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Panduan SI-GUSTI</h1>
                    
                    <!-- Table of Contents -->
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Daftar Isi</h3>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                            <li><a href="#tentang-sigusti" class="text-green-600 hover:text-green-700">Tentang SI-GUSTI</a></li>
                            <li><a href="#fitur-utama" class="text-green-600 hover:text-green-700">Fitur Utama</a></li>
                            <li><a href="#cara-penggunaan" class="text-green-600 hover:text-green-700">Cara Penggunaan</a></li>
                            <li><a href="#manfaat" class="text-green-600 hover:text-green-700">Manfaat</a></li>
                            <li><a href="#akses-sistem" class="text-green-600 hover:text-green-700">Akses Sistem</a></li>
                            <li><a href="#bantuan" class="text-green-600 hover:text-green-700">Bantuan</a></li>
                        </ul>
                    </div>
                    
                    <div class="prose max-w-none">
                        <h2 id="tentang-sigusti" class="flex items-center text-xl font-semibold mt-8 pb-2 border-b border-gray-200">
                            <svg class="h-6 w-6 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Tentang SI-GUSTI
                        </h2>
                        <p><strong>SI-GUSTI (Sistem Informasi Growth Up Stimulation)</strong> adalah platform digital yang membantu orangtua dan tenaga kesehatan memantau tumbuh kembang balita secara optimal. Sistem ini menggunakan standar WHO dan pedoman Kementerian Kesehatan RI untuk memberikan informasi yang akurat dan terpercaya.</p>
                        
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 my-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2h.01a1 1 0 000-2H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        <strong>Target Pengguna:</strong> SI-GUSTI dirancang untuk orangtua, pengasuh, bidan, dan petugas puskesmas yang peduli dengan tumbuh kembang balita usia 0-5 tahun.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <h3 id="fitur-utama" class="flex items-center text-lg font-medium mt-6">
                            <svg class="h-5 w-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Fitur Utama SI-GUSTI
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 mt-4">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-8 w-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">📊 Monitoring Pertumbuhan</h4>
                                        <p class="text-sm text-gray-600 mt-1">Catat dan pantau berat badan, tinggi badan balita dengan grafik pertumbuhan berstandar WHO. Dapatkan analisis status gizi secara otomatis.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-8 w-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">🧠 Asesmen Perkembangan KPSP</h4>
                                        <p class="text-sm text-gray-600 mt-1">Evaluasi perkembangan motorik, bahasa, dan sosial balita menggunakan Kuesioner Pra Skrining Perkembangan yang terstandar.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-8 w-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="h-5 w-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">📚 Materi Edukasi</h4>
                                        <p class="text-sm text-gray-600 mt-1">Akses video dan panduan stimulasi tumbuh kembang sesuai usia balita. Pelajari cara tepat bermain dan merangsang perkembangan anak.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-8 w-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="h-5 w-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">💬 Konsultasi Real-time</h4>
                                        <p class="text-sm text-gray-600 mt-1">Chatting langsung dengan bidan atau petugas kesehatan untuk konsultasi tumbuh kembang balita kapan saja dibutuhkan.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-8 w-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="h-5 w-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">📋 Riwayat Lengkap</h4>
                                        <p class="text-sm text-gray-600 mt-1">Simpan dan lihat riwayat pemeriksaan, pertumbuhan, dan perkembangan balita dari waktu ke waktu dalam satu platform.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-8 w-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="h-5 w-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">⚡ Rekomendasi Cerdas</h4>
                                        <p class="text-sm text-gray-600 mt-1">Dapatkan saran dan rekomendasi tindakan berdasarkan hasil pemeriksaan dan kondisi tumbuh kembang balita.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 id="cara-penggunaan" class="flex items-center text-lg font-medium mt-8">
                            <svg class="h-5 w-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Cara Menggunakan SI-GUSTI
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
                            <div class="bg-green-50 rounded-lg p-6">
                                <h4 class="font-semibold text-green-800 mb-4 flex items-center">
                                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                    </svg>
                                    👨‍⚕️ Untuk Tenaga Kesehatan
                                </h4>
                                <div class="space-y-3 text-sm text-green-700">
                                    <div class="flex items-start">
                                        <span class="bg-green-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">1</span>
                                        <span>Daftarkan dan kelola data balita di wilayah kerja</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="bg-green-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">2</span>
                                        <span>Lakukan pemeriksaan rutin dengan mencatat berat dan tinggi badan</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="bg-green-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">3</span>
                                        <span>Isi kuisioner KPSP untuk evaluasi perkembangan balita</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="bg-green-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">4</span>
                                        <span>Berikan konsultasi dan edukasi kepada orangtua melalui fitur chat</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="bg-green-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">5</span>
                                        <span>Pantau dan kelola materi edukasi untuk orangtua</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-blue-50 rounded-lg p-6">
                                <h4 class="font-semibold text-blue-800 mb-4 flex items-center">
                                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    👪 Untuk Orangtua
                                </h4>
                                <div class="space-y-3 text-sm text-blue-700">
                                    <div class="flex items-start">
                                        <span class="bg-blue-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">1</span>
                                        <span>Daftar akun dan lengkapi data balita Anda</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="bg-blue-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">2</span>
                                        <span>Lihat riwayat pertumbuhan dan perkembangan balita dalam grafik</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="bg-blue-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">3</span>
                                        <span>Pelajari materi stimulasi yang sesuai dengan usia anak</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="bg-blue-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">4</span>
                                        <span>Konsultasi langsung dengan bidan melalui fitur chat</span>
                                    </div>
                                    <div class="flex items-start">
                                        <span class="bg-blue-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-3 mt-0.5">5</span>
                                        <span>Dapatkan reminder jadwal pemeriksaan rutin</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 id="manfaat" class="flex items-center text-lg font-medium mt-8">
                            <svg class="h-5 w-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            Manfaat SI-GUSTI
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-2">Deteksi Dini</h4>
                                <p class="text-sm text-gray-600">Mendeteksi masalah tumbuh kembang sejak dini untuk penanganan yang tepat waktu</p>
                            </div>

                            <div class="text-center">
                                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-2">Edukasi Tepat</h4>
                                <p class="text-sm text-gray-600">Memberikan edukasi stimulasi yang sesuai dengan tahap perkembangan balita</p>
                            </div>

                            <div class="text-center">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-2">Akses Mudah</h4>
                                <p class="text-sm text-gray-600">Memudahkan akses layanan kesehatan anak tanpa harus datang ke puskesmas</p>
                            </div>
                        </div>

                        <h3 id="akses-sistem" class="flex items-center text-lg font-medium mt-8">
                            <svg class="h-5 w-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Cara Akses SI-GUSTI
                        </h3>

                        <div class="bg-gray-50 rounded-lg p-6 mt-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">📱 Akses Melalui Device</h4>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Smartphone Android & iOS
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Laptop & Komputer Desktop
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Tablet
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-3">🌐 Browser yang Didukung</h4>
                                    <ul class="space-y-2 text-sm text-gray-700">
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Google Chrome (Direkomendasikan)
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Mozilla Firefox
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Safari & Microsoft Edge
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <h3 id="bantuan" class="flex items-center text-lg font-medium mt-8">
                            <svg class="h-5 w-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Bantuan & Dukungan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-2">Kontak Email</h4>
                                <p class="text-sm text-gray-600 mb-3">Kirim pertanyaan atau laporan masalah</p>
                                <a href="mailto:support@sigusti.com" class="text-green-600 hover:text-green-700 text-sm font-medium">support@sigusti.com</a>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-2">Chat dengan Bidan</h4>
                                <p class="text-sm text-gray-600 mb-3">Konsultasi langsung melalui sistem</p>
                                <span class="text-blue-600 text-sm font-medium">Fitur Chat Internal</span>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2h.01a1 1 0 000-2H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-2">Panduan Lengkap</h4>
                                <p class="text-sm text-gray-600 mb-3">Video tutorial dan FAQ</p>
                                <span class="text-purple-600 text-sm font-medium">Menu Materi Edukasi</span>
                            </div>
                        </div>

                        <div class="mt-8 p-6 bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-3">💡 Tips Penggunaan Optimal</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <ul class="space-y-2 text-gray-700">
                                    <li class="flex items-start">
                                        <span class="text-green-500 mr-2">•</span>
                                        <span>Lakukan pemeriksaan rutin setiap bulan untuk memantau pertumbuhan</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-green-500 mr-2">•</span>
                                        <span>Manfaatkan materi edukasi untuk stimulasi harian di rumah</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-green-500 mr-2">•</span>
                                        <span>Jangan ragu bertanya melalui fitur chat jika ada kekhawatiran</span>
                                    </li>
                                </ul>
                                <ul class="space-y-2 text-gray-700">
                                    <li class="flex items-start">
                                        <span class="text-blue-500 mr-2">•</span>
                                        <span>Simpan data dengan lengkap untuk analisis yang akurat</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-blue-500 mr-2">•</span>
                                        <span>Ikuti jadwal kontrol yang direkomendasikan sistem</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-blue-500 mr-2">•</span>
                                        <span>Bagikan informasi penting dengan pasangan atau keluarga</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
