<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('chat.index') }}" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <span class="text-green-800 font-medium text-sm">
                            {{ strtoupper(substr($chatUser->name, 0, 2)) }}
                        </span>
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">{{ $chatUser->name }}</h1>
                        <p class="text-sm text-gray-500">
                            {{ $chatUser->is_admin ? 'Admin Puskesmas' : 'Masyarakat' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="bg-white shadow-sm rounded-lg flex flex-col h-96">
                <div class="flex-1 overflow-y-auto p-6 space-y-4" id="chat-messages">
                    @forelse($messages as $message)
                        <div class="flex {{ $message->from_user_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-xs lg:max-w-md">
                                <div class="px-4 py-2 rounded-lg {{ $message->from_user_id == auth()->id() ? 'bg-gradient-to-r from-green-500 to-green-600 text-white' : 'bg-gray-100 text-gray-900' }}">
                                    <p class="text-sm">{{ $message->message }}</p>
                                </div>
                                <div class="mt-1 flex {{ $message->from_user_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                                    <span class="text-xs text-gray-500">
                                        {{ $message->created_at->format('H:i') }}
                                        @if($message->from_user_id == auth()->id() && $message->seen)
                                            <span class="text-green-600">✓✓</span>
                                        @elseif($message->from_user_id == auth()->id())
                                            <span class="text-gray-400">✓</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <p class="text-gray-500 mt-2">Belum ada pesan</p>
                            <p class="text-gray-400 text-sm">Mulai percakapan dengan mengirim pesan</p>
                        </div>
                    @endforelse
                </div>

                <!-- Message Input -->
                <div class="border-t border-gray-200 p-4">
                    <form action="{{ route('chat.send') }}" method="POST" class="flex space-x-3">
                        @csrf
                        <input type="hidden" name="from_user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="to_user_id" value="{{ $chatUser->id }}">
                        <div class="flex-1">
                            <x-text-input 
                                name="message" 
                                placeholder="Ketik pesan..." 
                                required 
                                class="w-full"
                                leadingIcon='<svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>'
                            />
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            <span class="sr-only">Kirim</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto scroll to bottom
        document.addEventListener('DOMContentLoaded', function() {
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });

        // Auto refresh messages every 10 seconds
        setInterval(function() {
            location.reload();
        }, 10000);
    </script>
</x-app-layout>
