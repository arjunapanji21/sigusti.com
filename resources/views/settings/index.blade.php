<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-base-dark">Application Settings</h2>
                <p class="mt-1 text-base">Configure your application preferences and settings.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sidebar Navigation -->
                <div class="col-span-1">
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        <nav class="p-4">
                            <a href="#general" class="block px-3 py-2 rounded-md bg-primary/10 text-primary font-medium">
                                General Settings
                            </a>
                            @if(auth()->user()->isAdmin())
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <h3 class="px-3 text-xs font-semibold text-base-light uppercase tracking-wider">Admin Settings</h3>
                                <a href="#site-settings" class="block px-3 py-2 rounded-md text-base hover:bg-background hover:text-primary mt-1">
                                    Site Settings
                                </a>
                            </div>
                            @endif
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-span-1 md:col-span-2">
                    <!-- General Settings Section -->
                    <div id="general" class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-base-dark">General Settings</h3>
                        </div>
                        <div class="p-6">
                            <form action="#" method="POST">
                                @csrf
                                <div class="space-y-6">
                                    <x-select-search name="language" 
                                        label="Language"
                                        :options="[
                                            'en' => 'English',
                                            'es' => 'Spanish',
                                            'fr' => 'French',
                                            'de' => 'German'
                                        ]"
                                        helper="Choose your preferred language for the interface."
                                    />
                                    
                                    <x-select-search name="timezone" 
                                        label="Default Timezone"
                                        :options="[
                                            'UTC' => 'UTC',
                                            'America/New_York' => 'Eastern Time (US & Canada)',
                                            'America/Chicago' => 'Central Time (US & Canada)',
                                            'America/Denver' => 'Mountain Time (US & Canada)',
                                            'America/Los_Angeles' => 'Pacific Time (US & Canada)'
                                        ]"
                                        helper="Select the default timezone for display of dates and times."
                                    />

                                    <x-select-search name="date_format" 
                                        label="Date Format"
                                        :options="[
                                            'Y-m-d' => '2023-12-31',
                                            'm/d/Y' => '12/31/2023',
                                            'd/m/Y' => '31/12/2023',
                                            'M j, Y' => 'Dec 31, 2023'
                                        ]"
                                        helper="Choose how dates will be displayed throughout the application."
                                    />
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        Save Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    @if(auth()->user()->isAdmin())
                    <!-- Admin: Site Settings -->
                    <div id="site-settings" class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
                        <div class="px-6 py-4 border-b border-gray-200 flex items-center">
                            <h3 class="text-lg font-medium text-base-dark">Site Settings</h3>
                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Admin Only
                            </span>
                        </div>
                        <div class="p-6">
                            <form action="#" method="POST">
                                @csrf
                                <div class="space-y-6">
                                    <x-text-input
                                        name="site_name"
                                        label="Site Name"
                                        value="SI-GUSTI"
                                        helper="The name of your application as it appears to users."
                                        leadingIcon='<svg class="h-5 w-5 text-base-light" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" /></svg>'
                                    />
                                    
                                    <x-textarea
                                        name="site_description"
                                        label="Site Description"
                                        value="A powerful starter kit for Laravel 12 applications"
                                        rows="3"
                                        helper="A brief description of your application to be used in meta tags and app descriptions."
                                        leadingIcon='<svg class="h-5 w-5 text-base-light" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" /></svg>'
                                    />

                                    <div>
                                        <label for="maintenance_mode" class="flex items-center text-sm font-medium text-base-dark">
                                            <input id="maintenance_mode" name="maintenance_mode" type="checkbox" class="h-4 w-4 rounded border-base-light/30 text-primary focus:ring-primary">
                                            <span class="ml-2">Enable Maintenance Mode</span>
                                        </label>
                                        <p class="mt-1 text-sm text-base-light ml-6">When enabled, non-admin users will see a maintenance page when visiting the site.</p>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        Update Site Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
