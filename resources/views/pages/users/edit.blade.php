<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="">
            <div class="px-4 py-6 sm:px-6">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">{{ isset($user) ? 'Edit User' : 'Create User' }}</h2>
                        <p class="mt-1 text-sm text-gray-500">{{ isset($user) ? 'Update user details' : 'Create a new user account' }}</p>
                    </div>
                    <div>
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md  text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Users
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="mt-6 bg-white shadow rounded-lg p-2">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex" aria-label="Progress">
                    <button type="button" onclick="showTab('basic')" class="tab-btn border-green-500 text-green-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Basic Information
                    </button>
                    <button type="button" onclick="showTab('security')" class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Security Settings
                    </button>
                </nav>
            </div>

            <div class="p-6">
                <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif

                    <!-- Basic Information Tab -->
                    <div id="basic-tab" class="tab-content">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" 
                                    class="p-2 bg-gray-50 mt-1 block w-full rounded-md border-gray-300  focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" 
                                    class="p-2 bg-gray-50 mt-1 block w-full rounded-md border-gray-300  focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone ?? '') }}" 
                                    class="p-2 bg-gray-50 mt-1 block w-full rounded-md border-gray-300  focus:border-green-500 focus:ring-green-500 sm:text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }} 
                                            class="rounded border-gray-300 text-green-600  focus:border-green-500 focus:ring-green-500">
                                        <span class="ml-2 text-sm text-gray-600">Active</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Settings Tab -->
                    <div id="security-tab" class="tab-content hidden">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                                <input type="password" name="password" id="password" 
                                    class="p-2 bg-gray-50 mt-1 block w-full rounded-md border-gray-300  focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                    class="p-2 bg-gray-50 mt-1 block w-full rounded-md border-gray-300  focus:border-green-500 focus:ring-green-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('users.index') }}" class="rounded-md bg-white py-2 px-4 text-sm font-medium text-gray-700  border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Cancel</a>
                            <button type="submit" class="rounded-md bg-green-600 py-2 px-4 text-sm font-medium text-white  hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            
            document.getElementById(tabName + '-tab').classList.remove('hidden');
            
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-green-500', 'text-green-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            const activeBtn = document.querySelector(`button[onclick="showTab('${tabName}')"]`);
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
            activeBtn.classList.add('border-green-500', 'text-green-600');
        }

        // Show first tab by default
        showTab('basic');
    </script>
</x-app-layout>
