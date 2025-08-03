@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center space-x-3">
        <a href="{{ route('chat.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h1 class="text-2xl font-semibold text-gray-900">Pesan Baru</h1>
    </div>

    <!-- Form -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Kirim Pesan ke Admin Puskesmas</h3>
        </div>
        <form action="{{ route('chat.send') }}" method="POST" class="p-6 space-y-6">
            @csrf
            <input type="hidden" name="from_user_id" value="{{ auth()->id() }}">
            
            <div>
                <label for="to_user_id" class="block text-sm font-medium text-gray-700">Pilih Admin</label>
                <select name="to_user_id" id="to_user_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    <option value="">Pilih Admin Puskesmas</option>
                    @foreach(App\Models\User::where('is_admin', true)->where('wilayah_id', auth()->user()->wilayah_id)->get() as $admin)
                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                <textarea name="message" id="message" rows="4" required placeholder="Ketik pesan Anda..."
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"></textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('chat.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Kirim Pesan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
