<x-app-layout>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <a href="{{ route('balita.show', $balitum) }}" class="mr-4 text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Edit Data Balita</h1>
                            <p class="mt-1 text-sm text-gray-600">
                                Ubah informasi data balita {{ $balitum->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white shadow sm:rounded-lg">
                <form action="{{ route('balita.update', $balitum) }}" method="POST" class="space-y-6 p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <x-text-input 
                            name="name" 
                            label="Nama Balita" 
                            value="{{ old('name', $balitum->name) }}" 
                            placeholder="Masukkan nama balita"
                            required />

                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="gender" id="gender" required
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('gender', $balitum->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender', $balitum->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <x-text-input 
                            type="date" 
                            name="tgl_lahir" 
                            label="Tanggal Lahir" 
                            value="{{ old('tgl_lahir', $balitum->tgl_lahir->format('Y-m-d')) }}" 
                            max="{{ date('Y-m-d') }}"
                            required />

                        <x-text-input 
                            name="ibu" 
                            label="Nama Ibu" 
                            value="{{ old('ibu', $balitum->ibu) }}" 
                            placeholder="Masukkan nama ibu"
                            required />

                        <div class="sm:col-span-2">
                            <label for="wilayah_id" class="block text-sm font-medium text-gray-700">Wilayah</label>
                            <select name="wilayah_id" id="wilayah_id" required
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                <option value="">Pilih Wilayah</option>
                                @foreach($wilayah as $item)
                                    <option value="{{ $item->id }}" {{ old('wilayah_id', $balitum->wilayah_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('wilayah_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" onclick="confirmDelete()" 
                                class="bg-red-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Hapus Data
                        </button>
                        
                        <div class="flex space-x-3">
                            <a href="{{ route('balita.show', $balitum) }}" 
                               class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Perbarui Data
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Hidden Delete Form -->
                <form id="delete-form" action="{{ route('balita.destroy', $balitum) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus data balita ini? Tindakan ini tidak dapat dibatalkan.')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
    @endpush
</x-app-layout>
