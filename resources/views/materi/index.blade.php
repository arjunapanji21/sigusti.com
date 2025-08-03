@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Materi Edukasi</h1>
            <p class="mt-2 text-sm text-gray-700">Kelola materi edukasi untuk stimulasi tumbuh kembang balita</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('materi.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Materi
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white shadow rounded-lg p-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="kategori" id="kategori" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    <option value="">Semua Kategori</option>
                    <option value="stimulasi">Stimulasi</option>
                    <option value="nutrisi">Nutrisi</option>
                    <option value="kesehatan">Kesehatan</option>
                    <option value="tumbuh_kembang">Tumbuh Kembang</option>
                </select>
            </div>
            <div>
                <label for="usia" class="block text-sm font-medium text-gray-700">Usia Target</label>
                <input type="text" name="usia" id="usia" placeholder="Cari usia target..." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
            </div>
            <div class="md:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700">Pencarian</label>
                <input type="text" name="search" id="search" placeholder="Cari judul atau deskripsi..." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
            </div>
        </form>
    </div>

    <!-- Content -->
    <div class="bg-white shadow rounded-lg">
        @if($materi->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                @foreach($materi as $item)
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300 bg-white">
                        @if($item->type == 'video' && $item->path)
                            @php
                                // Extract YouTube video ID from embed URL or regular URL
                                preg_match('/(?:youtube\.com\/(?:embed\/|watch\?v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $item->path, $matches);
                                $videoId = $matches[1] ?? null;
                                $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg" : null;
                            @endphp
                            @if($thumbnailUrl)
                                <div class="relative group">
                                    <img src="{{ $thumbnailUrl }}" alt="{{ $item->title }}" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                                    <div class="absolute top-2 right-2">
                                        <span class="bg-red-600 text-white text-xs px-2 py-1 rounded-full font-medium">
                                            VIDEO
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="h-12 w-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-gray-500 text-sm">Video</p>
                                    </div>
                                </div>
                            @endif
                        @elseif($item->type == 'pdf' && $item->path)
                            <div class="w-full h-48 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center relative">
                                <div class="text-center">
                                    <svg class="h-12 w-12 text-blue-500 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                    </svg>
                                    <p class="text-blue-600 text-sm font-medium">PDF</p>
                                </div>
                                <div class="absolute top-2 right-2">
                                    <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded-full font-medium">
                                        PDF
                                    </span>
                                </div>
                            </div>
                        @elseif($item->gambar)
                            <div class="relative group">
                                <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                                <div class="absolute top-2 right-2">
                                    <span class="bg-green-600 text-white text-xs px-2 py-1 rounded-full font-medium">
                                        GAMBAR
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="h-12 w-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-gray-500 text-sm">Tidak ada media</p>
                                </div>
                            </div>
                        @endif
                        
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $item->kategori_label }}
                                </span>
                                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">{{ $item->usia_target }}</span>
                            </div>
                            
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $item->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($item->deskripsi, 100) }}</p>
                            
                            <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                                <span class="text-xs text-gray-500">{{ $item->created_at->format('d M Y') }}</span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('materi.show', $item) }}" class="text-green-600 hover:text-green-700 text-sm font-medium transition-colors">
                                        Lihat
                                    </a>
                                    <a href="{{ route('materi.edit', $item) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('materi.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $materi->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h3a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4zM6 6v12h12V6H6zm3 3h6v2H9V9zm0 4h6v2H9v-2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada materi</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan materi edukasi pertama.</p>
                <div class="mt-6">
                    <a href="{{ route('materi.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                        Tambah Materi
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
