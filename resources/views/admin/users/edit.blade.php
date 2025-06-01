<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-base-dark">Edit User</h2>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                    Back to Users
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-lg overflow-hidden p-6">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-text-input
                            name="name"
                            label="Name"
                            value="{{ old('name', $user->name) }}"
                            required
                            helper="User's full name as it will appear in the system"
                        />

                        <x-text-input
                            type="email"
                            name="email"
                            label="Email Address" 
                            value="{{ old('email', $user->email) }}"
                            required
                            helper="Must be unique and will be used for login"
                        />

                        <x-text-input
                            type="password"
                            name="password"
                            label="Password"
                            helper="Leave blank to keep current password. Must be at least 8 characters if changed."
                        />

                        <x-text-input
                            type="password"
                            name="password_confirmation"
                            label="Confirm Password"
                            helper="Repeat the password to confirm"
                        />

                        <x-select-search
                            name="role"
                            label="Role"
                            :options="['user' => 'User', 'admin' => 'Admin']"
                            value="{{ old('role', $user->hasRole('admin') ? 'admin' : 'user') }}"
                            helper="Assign a role to the user"
                        />

                        <x-select-search
                            name="status"
                            label="Status"
                            :options="['active' => 'Active', 'inactive' => 'Inactive']"
                            value="{{ old('status', $user->status) }}"
                            helper="Set the user's account status"
                        />
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
