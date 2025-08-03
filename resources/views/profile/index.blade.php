<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-base-dark">Profile Settings</h2>
                <p class="mt-1 text-base">Manage your account information and preferences.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sidebar Navigation -->
                <div class="col-span-1">
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center">
                                        <span
                                            class="text-primary font-medium text-lg">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-base font-medium text-base-dark">{{ auth()->user()->name }}</h3>
                                    <p class="text-sm text-base-light">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <nav class="p-2">
                            <a href="#personal-info"
                                class="block px-3 py-2 rounded-md bg-primary/10 text-primary font-medium">
                                Personal Information
                            </a>
                            <a href="#security"
                                class="block px-3 py-2 rounded-md text-base hover:bg-background hover:text-primary mt-1">
                                Security
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-span-1 md:col-span-2">
                    <!-- Personal Information Section -->
                    <div id="personal-info" class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-base-dark">Personal Information</h3>
                        </div>
                        <div class="p-6">
                            <form action="#" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <x-text-input name="name" label="Full Name" value="{{ auth()->user()->name }}"
                                        required
                                        leadingIcon='<svg class="h-5 w-5 text-base-light" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>'
                                        helper="Your full name as it will appear on your profile" />

                                    <x-text-input type="email" name="email" label="Email Address"
                                        value="{{ auth()->user()->email }}" required
                                        leadingIcon='<svg class="h-5 w-5 text-base-light" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>'
                                        helper="We'll never share your email with anyone else" />

                                    <x-text-input type="tel" name="phone" label="Phone Number"
                                        value="{{ auth()->user()->phone ?? '' }}"
                                        leadingIcon='<svg class="h-5 w-5 text-base-light" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>'
                                        placeholder="Enter your phone number"
                                        helper="Optional. For account recovery and notifications." />

                                    <x-select-search name="is_admin" label="Role"
                                        :options="[0 => 'Pengguna', 1 => 'Admin']"
                                        :selected="auth()->user()->is_admin ? 1 : 0"
                                        leadingIcon='<svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>'
                                        helper="Select your role in the system." />
                                </div>
                                <div class="mt-6">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div id="security" class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-base-dark">Security</h3>
                        </div>
                        <div class="p-6">
                            <form action="#" method="POST">
                                @csrf
                                <div class="space-y-6">
                                    <x-text-input type="password" name="current_password" label="Current Password"
                                        autocomplete="current-password"
                                        helper="Enter your current password to update your account settings."/>

                                    <x-text-input type="password" name="new_password" label="New Password"
                                        autocomplete="new-password" 
                                        helper="Your new password must be at least 8 characters long and include a mix of letters, numbers, and symbols." />

                                    <x-text-input type="password" name="new_password_confirmation"
                                        label="Confirm New Password" autocomplete="new-password"
                                        helper="Re-enter your new password for confirmation." />
                                </div>
                                <div class="mt-6">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
