<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-base-dark">Add New User</h2>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    Back to Users
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden p-6">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-base-dark">Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full border border-base-light/30 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-base-dark">Email Address</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full border border-base-light/30 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" value="{{ old('email') }}" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-base-dark">Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full border border-base-light/30 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-base-dark">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border border-base-light/30 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" required>
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-medium text-base-dark">Role</label>
                            <select name="role" id="role" class="mt-1 block w-full border border-base-light/30 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
