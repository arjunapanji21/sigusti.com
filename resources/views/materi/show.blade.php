@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">{{ $materi->judul }}</h1>
            <div class="mt-2 flex items-center space-x-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    {{ $materi->kategori_label }}
                </span>
                <span class="text-sm text-gray-500">Usia Target: {{ $materi->usia_target }}</span>
                <span class="text-sm text-gray-500">{{ $materi->created_at->format('d M Y') }}</span>
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('materi.edit', $materi) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                Edit
            </a>
            <a href="{{ route('materi.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Video or Image -->
        @if($materi->type == 'video' && $materi->path)
            @if(str_contains($materi->path, 'youtube') && isset($videoId) && $videoId)
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-96" 
                            src="https://www.youtube.com/embed/{{ $videoId }}" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
            @else
                <div class="w-full h-64 bg-gray-100 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <p class="mt-2 text-gray-500">Video tidak dapat dimuat</p>
                        <a href="{{ $materi->path }}" target="_blank" class="mt-2 text-green-600 hover:text-green-900">
                            Buka Video di Tab Baru
                        </a>
                    </div>
                </div>
            @endif
        @elseif($materi->gambar)
            <div class="aspect-w-16 aspect-h-9">
                <img src="{{ Storage::url($materi->gambar) }}" alt="{{ $materi->judul }}" class="w-full h-64 object-cover">
            </div>
        @endif

        <div class="p-6">
            <!-- Description -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Deskripsi</h3>
                <p class="text-gray-600">{{ $materi->deskripsi }}</p>
            </div>

            <!-- Content -->
            @if($materi->konten)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Konten Materi</h3>
                    <div class="prose max-w-none text-gray-600">
                        {!! nl2br(e($materi->konten)) !!}
                    </div>
                </div>
            @endif

            <!-- Remove old video section since we now display it at the top -->
            @if($materi->tipe == 'pdf' && $materi->path)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">File PDF</h3>
                    <a href="{{ $materi->path }}" target="_blank" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-4.5B7.875 8.25 6 10.125 6 12.75v2.625"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 017.5 7.5v6.75a2.25 2.25 0 11-4.5 0V13.5a3 3 0 10-6 0v6.75a2.25 2.25 0 11-4.5 0V13.5A7.5 7.5 0 0110.5 6z"/>
                        </svg>
                        Lihat PDF
                    </a>
                </div>
            @endif

            <!-- File Attachment -->
            @if($materi->file_attachment)
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">File Lampiran</h3>
                    <a href="{{ Storage::url($materi->file_attachment) }}" target="_blank" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                        </svg>
                        {{ basename($materi->file_attachment) }}
                    </a>
                </div>
            @endif

            <!-- Meta Information -->
            <div class="border-t border-gray-200 pt-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dibuat pada</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $materi->created_at->format('d F Y, H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Terakhir diperbarui</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $materi->updated_at->format('d F Y, H:i') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
