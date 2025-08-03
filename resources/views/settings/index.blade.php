<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">Application Settings</h2>
                <p class="mt-1 text-gray-600">Configure your application preferences and settings.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sidebar Navigation -->
                <div class="col-span-1">
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        <nav class="p-4">
                            <a href="#general" class="block px-3 py-2 rounded-md bg-green-100 text-green-800 font-medium">
                                General Settings
                            </a>
                            @if(auth()->user()->isAdmin())
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin Settings</h3>
                                <a href="#site-settings" class="block px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100 hover:text-green-700 mt-1">
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
                            <h3 class="text-lg font-medium text-gray-900">General Settings</h3>
                        </div>
                        <div class="p-6">
                            <form action="#" method="POST">
                                @csrf
                                <div class="space-y-6">
                                    <div>
                                        <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
                                        <select name="language" id="language" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            <option value="en">English</option>
                                            <option value="es">Spanish</option>
                                            <option value="fr">French</option>
                                            <option value="de">German</option>
                                        </select>
                                        <p class="mt-1 text-sm text-gray-500">Choose your preferred language for the interface.</p>
                                    </div>
                                    
                                    <div>
                                        <label for="timezone" class="block text-sm font-medium text-gray-700">Default Timezone</label>
                                        <select name="timezone" id="timezone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            <option value="UTC">UTC</option>
                                            <option value="America/New_York">Eastern Time (US & Canada)</option>
                                            <option value="America/Chicago">Central Time (US & Canada)</option>
                                            <option value="America/Denver">Mountain Time (US & Canada)</option>
                                            <option value="America/Los_Angeles">Pacific Time (US & Canada)</option>
                                        </select>
                                        <p class="mt-1 text-sm text-gray-500">Select the default timezone for display of dates and times.</p>
                                    </div>

                                    <div>
                                        <label for="date_format" class="block text-sm font-medium text-gray-700">Date Format</label>
                                        <select name="date_format" id="date_format" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            <option value="Y-m-d">2023-12-31</option>
                                            <option value="m/d/Y">12/31/2023</option>
                                            <option value="d/m/Y">31/12/2023</option>
                                            <option value="M j, Y">Dec 31, 2023</option>
                                        </select>
                                        <p class="mt-1 text-sm text-gray-500">Choose how dates will be displayed throughout the application.</p>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
                            <h3 class="text-lg font-medium text-gray-900">Site Settings</h3>
                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Admin Only
                            </span>
                        </div>
                        <div class="p-6">
                            <form action="#" method="POST">
                                @csrf
                                <div class="space-y-6">
                                    <div>
                                        <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                                        <input type="text" name="site_name" id="site_name" value="SI-GUSTI" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                        <p class="mt-1 text-sm text-gray-500">The name of your application as it appears to users.</p>
                                    </div>
                                    
                                    <div>
                                        <label for="site_description" class="block text-sm font-medium text-gray-700">Site Description</label>
                                        <textarea name="site_description" id="site_description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">A powerful system for monitoring child growth and development</textarea>
                                        <p class="mt-1 text-sm text-gray-500">A brief description of your application to be used in meta tags and app descriptions.</p>
                                    </div>

                                    <div>
                                        <label for="maintenance_mode" class="flex items-center text-sm font-medium text-gray-700">
                                            <input id="maintenance_mode" name="maintenance_mode" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                                            <span class="ml-2">Enable Maintenance Mode</span>
                                        </label>
                                        <p class="mt-1 text-sm text-gray-500 ml-6">When enabled, non-admin users will see a maintenance page when visiting the site.</p>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
