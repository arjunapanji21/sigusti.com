<x-app-layout>
    <!-- Mobile App Layout -->
    <div class="min-h-screen bg-gray-50">
        <!-- Header Card -->
        <div class="bg-white shadow-sm">
            <div class="px-4 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">
                            Halo, {{ explode(' ', auth()->user()->name)[0] }}!
                            @if(auth()->user()->is_admin)
                                <span class="text-sm text-green-600 font-medium">(Admin)</span>
                            @endif
                        </h1>
                        <p class="text-sm text-gray-600">
                            @if(auth()->user()->is_admin)
                                Kelola sistem SI-GUSTI
                            @else
                                Monitor tumbuh kembang si kecil
                            @endif
                        </p>
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
                    <a href="{{ route('balita.index') }}" class="flex flex-col items-center p-3 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Balita</span>
                    </a>
                    
                    <a href="{{ route('pemeriksaan.index') }}" class="flex flex-col items-center p-3 rounded-lg bg-green-50 hover:bg-green-100 transition-colors">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c0 .621-.504 1.125-1.125 1.125H18a2.25 2.25 0 01-2.25-2.25V10.5M8.25 8.25V6a2.25 2.25 0 012.25-2.25h1.5c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125H9a2.25 2.25 0 01-2.25-2.25z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Pemeriksaan</span>
                    </a>
                    
                    <a href="{{ route('materi.index') }}" class="flex flex-col items-center p-3 rounded-lg bg-purple-50 hover:bg-purple-100 transition-colors">
                        <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Materi</span>
                    </a>
                    
                    <a href="{{ route('pemeriksaan.index') }}" class="flex flex-col items-center p-3 rounded-lg bg-yellow-50 hover:bg-yellow-100 transition-colors">
                        <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Riwayat</span>
                    </a>
                    
                    <a href="{{ route('chat.index') }}" class="flex flex-col items-center p-3 rounded-lg bg-red-50 hover:bg-red-100 transition-colors">
                        <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Chat</span>
                    </a>
                    
                    @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center p-3 rounded-lg bg-indigo-50 hover:bg-indigo-100 transition-colors">
                        <div class="w-12 h-12 bg-indigo-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Pengguna</span>
                    </a>
                    @else
                    <a href="{{ route('settings.index') }}" class="flex flex-col items-center p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                        <div class="w-12 h-12 bg-gray-500 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-700 text-center">Pengaturan</span>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Stats Overview -->
            @php
                if (auth()->user()->isAdmin()) {
                    $totalBalita = \App\Models\Balita::count();
                    $totalPemeriksaan = \App\Models\Pemeriksaan::count();
                    $totalUsers = \App\Models\User::where('role', 'user')->count();
                    $pemeriksaanBulanIni = \App\Models\Pemeriksaan::whereMonth('created_at', now()->month)->count();
                } else {
                    $totalBalita = \App\Models\Balita::where('user_id', auth()->id())->count();
                    $totalPemeriksaan = \App\Models\Pemeriksaan::where('user_id', auth()->id())->count();
                    $giziBaik = \App\Models\Pemeriksaan::where('user_id', auth()->id())->where('kode_pertumbuhan', 'normal')->count();
                    $pemeriksaanBulanIni = \App\Models\Pemeriksaan::where('user_id', auth()->id())->whereMonth('created_at', now()->month)->count();
                }
            @endphp
            
            <div class="bg-white rounded-xl shadow-sm p-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Data</h2>
                <div class="grid grid-cols-2 gap-4">
                    @if(auth()->user()->is_admin)
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm">Total Balita</p>
                                    <p class="text-2xl font-bold">{{ $totalBalita }}</p>
                                </div>
                                <svg class="w-8 h-8 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-100 text-sm">Total Users</p>
                                    <p class="text-2xl font-bold">{{ $totalUsers }}</p>
                                </div>
                                <svg class="w-8 h-8 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-4 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-100 text-sm">Total Pemeriksaan</p>
                                    <p class="text-2xl font-bold">{{ $totalPemeriksaan }}</p>
                                </div>
                                <svg class="w-8 h-8 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c0 .621-.504 1.125-1.125 1.125H18a2.25 2.25 0 01-2.25-2.25V10.5M8.25 8.25V6a2.25 2.25 0 012.25-2.25h1.5c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125H9a2.25 2.25 0 01-2.25-2.25z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-4 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-yellow-100 text-sm">Bulan Ini</p>
                                    <p class="text-2xl font-bold">{{ $pemeriksaanBulanIni }}</p>
                                </div>
                                <svg class="w-8 h-8 text-yellow-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    @else
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm">Balita Saya</p>
                                    <p class="text-2xl font-bold">{{ $totalBalita }}</p>
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
                                    <p class="text-2xl font-bold">{{ $giziBaik }}</p>
                                </div>
                                <svg class="w-8 h-8 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-4 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-100 text-sm">Pemeriksaan</p>
                                    <p class="text-2xl font-bold">{{ $totalPemeriksaan }}</p>
                                </div>
                                <svg class="w-8 h-8 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c0 .621-.504 1.125-1.125 1.125H18a2.25 2.25 0 01-2.25-2.25V10.5M8.25 8.25V6a2.25 2.25 0 012.25-2.25h1.5c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125H9a2.25 2.25 0 01-2.25-2.25z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-4 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-yellow-100 text-sm">Bulan Ini</p>
                                    <p class="text-2xl font-bold">{{ $pemeriksaanBulanIni }}</p>
                                </div>
                                <svg class="w-8 h-8 text-yellow-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Data -->
            @if(auth()->user()->is_admin)
                @php
                    $recentBalita = \App\Models\Balita::with('user')->latest()->take(3)->get();
                @endphp
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Balita Terdaftar Terbaru</h2>
                        <a href="{{ route('balita.index') }}" class="text-green-600 text-sm font-medium">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                        @forelse($recentBalita as $balita)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-{{ ['pink', 'blue', 'purple', 'green', 'yellow'][array_rand(['pink', 'blue', 'purple', 'green', 'yellow'])] }}-500 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr($balita->name, 0, 2)) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $balita->name }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $balita->gender == 'L' ? 'Laki-laki' : 'Perempuan' }} • 
                                            Ibu: {{ $balita->ibu }} • 
                                            Owner: {{ $balita->user->name }}
                                        </p>
                                    </div>
                                </div>
                                <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                            </div>
                        @empty
                            <div class="text-center py-4 text-gray-500">
                                <p>Belum ada data balita</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @else
                @php
                    $userBalita = \App\Models\Balita::where('user_id', auth()->id())->latest()->take(3)->get();
                @endphp
                <div class="bg-white rounded-xl shadow-sm p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Data Balita Saya</h2>
                        <a href="{{ route('balita.index') }}" class="text-green-600 text-sm font-medium">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                        @forelse($userBalita as $balita)
                            @php
                                $birthDate = \Carbon\Carbon::parse($balita->tgl_lahir);
                                $ageInMonths = $birthDate->diffInMonths(\Carbon\Carbon::now());
                                $years = intval($ageInMonths / 12);
                                $months = $ageInMonths % 12;
                                $ageText = '';
                                if ($years > 0) {
                                    $ageText .= $years . ' tahun ';
                                }
                                if ($months > 0) {
                                    $ageText .= $months . ' bulan';
                                }
                                
                                // Get latest examination status
                                $latestExam = \App\Models\Pemeriksaan::where('nama_balita', $balita->name)
                                    ->where('user_id', auth()->id())
                                    ->latest()
                                    ->first();
                                $status = $latestExam ? ucfirst(str_replace('_', ' ', $latestExam->kode_pertumbuhan)) : 'Belum diperiksa';
                                $statusColor = match($latestExam?->kode_pertumbuhan ?? '') {
                                    'normal' => 'green',
                                    'kurang', 'sangat_kurang' => 'red',
                                    'lebih' => 'yellow',
                                    default => 'gray'
                                };
                            @endphp
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-{{ ['pink', 'blue', 'purple', 'green', 'yellow'][array_rand(['pink', 'blue', 'purple', 'green', 'yellow'])] }}-500 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr($balita->name, 0, 2)) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $balita->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $ageText ?: '< 1 bulan' }} • {{ $status }}</p>
                                    </div>
                                </div>
                                <span class="w-3 h-3 bg-{{ $statusColor }}-400 rounded-full"></span>
                            </div>
                        @empty
                            <div class="text-center py-4 text-gray-500">
                                <p>Belum ada data balita</p>
                                <a href="{{ route('balita.create') }}" class="text-green-600 text-sm font-medium">Daftarkan balita pertama</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
