@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Tambah Materi Edukasi</h1>
            <p class="mt-2 text-sm text-gray-700">Buat materi edukasi baru untuk stimulasi tumbuh kembang balita</p>
        </div>
        <a href="{{ route('materi.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white shadow rounded-lg">
        <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Judul -->
                <div class="md:col-span-2">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Judul Materi</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('judul') border-red-300 @enderror">
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="kategori" id="kategori" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('kategori') border-red-300 @enderror">
                        <option value="">Pilih Kategori</option>
                        <option value="stimulasi" {{ old('kategori') == 'stimulasi' ? 'selected' : '' }}>Stimulasi</option>
                        <option value="nutrisi" {{ old('kategori') == 'nutrisi' ? 'selected' : '' }}>Nutrisi</option>
                        <option value="kesehatan" {{ old('kategori') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="tumbuh_kembang" {{ old('kategori') == 'tumbuh_kembang' ? 'selected' : '' }}>Tumbuh Kembang</option>
                    </select>
                    @error('kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Usia Target -->
                <div>
                    <label for="usia_target" class="block text-sm font-medium text-gray-700">Usia Target</label>
                    <input type="text" name="usia_target" id="usia_target" value="{{ old('usia_target') }}" placeholder="Contoh: 0-6 bulan, 6-12 bulan" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('usia_target') border-red-300 @enderror">
                    @error('usia_target')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" required
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('deskripsi') border-red-300 @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konten -->
                <div class="md:col-span-2">
                    <label for="konten" class="block text-sm font-medium text-gray-700">Konten Materi</label>
                    <textarea name="konten" id="konten" rows="8" required
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('konten') border-red-300 @enderror">{{ old('konten') }}</textarea>
                    @error('konten')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" name="gambar" id="gambar" accept="image/*"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('gambar') border-red-300 @enderror">
                    <p class="mt-1 text-xs text-gray-500">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</p>
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video URL -->
                <div>
                    <label for="video_url" class="block text-sm font-medium text-gray-700">URL Video (Opsional)</label>
                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}" placeholder="https://youtube.com/watch?v=..."
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('video_url') border-red-300 @enderror">
                    @error('video_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File Attachment -->
                <div class="md:col-span-2">
                    <label for="file_attachment" class="block text-sm font-medium text-gray-700">File Lampiran (Opsional)</label>
                    <input type="file" name="file_attachment" id="file_attachment" accept=".pdf,.doc,.docx"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm @error('file_attachment') border-red-300 @enderror">
                    <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, DOCX. Maksimal 5MB.</p>
                    @error('file_attachment')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('materi.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Simpan Materi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
