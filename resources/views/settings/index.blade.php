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
                            <a href="#appearance" class="block px-3 py-2 rounded-md text-base hover:bg-background hover:text-primary mt-1">
                                Appearance
                            </a>
                            <a href="#notifications" class="block px-3 py-2 rounded-md text-base hover:bg-background hover:text-primary mt-1">
                                Notifications
                            </a>
                            <a href="#advanced" class="block px-3 py-2 rounded-md text-base hover:bg-background hover:text-primary mt-1">
                                Advanced
                            </a>
                            @if(auth()->user()->isAdmin())
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <h3 class="px-3 text-xs font-semibold text-base-light uppercase tracking-wider">Admin Settings</h3>
                                <a href="#site-settings" class="block px-3 py-2 rounded-md text-base hover:bg-background hover:text-primary mt-1">
                                    Site Settings
                                </a>
                                <a href="#api-keys" class="block px-3 py-2 rounded-md text-base hover:bg-background hover:text-primary mt-1">
                                    API Keys
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

                    <!-- Appearance Section -->
                    <div id="appearance" class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-base-dark">Appearance</h3>
                        </div>
                        <div class="p-6">
                            <form action="#" method="POST">
                                @csrf
                                <div class="space-y-8">
                                    <!-- Theme Mode Selection -->
                                    <div>
                                        <label class="block text-sm font-medium text-base-dark mb-3">Theme Mode</label>
                                        <div class="grid grid-cols-3 gap-4">
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="theme" value="light" class="sr-only peer" checked onchange="applyThemeMode('light')">
                                                <div class="overflow-hidden rounded-lg border-2 border-base-light/30 peer-checked:border-primary transition-all">
                                                    <div class="bg-white p-3">
                                                        <div class="h-24 rounded-md border border-base-light/20 bg-gray-50 flex flex-col">
                                                            <div class="h-4 bg-white border-b border-base-light/20 mb-1"></div>
                                                            <div class="flex-1 p-2">
                                                                <div class="w-12 h-2 bg-base-light/20 rounded mb-1"></div>
                                                                <div class="w-20 h-2 bg-base-light/20 rounded"></div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 text-center text-sm font-medium text-base-dark">Light</div>
                                                    </div>
                                                </div>
                                            </label>
                                            
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="theme" value="dark" class="sr-only peer" onchange="applyThemeMode('dark')">
                                                <div class="overflow-hidden rounded-lg border-2 border-base-light/30 peer-checked:border-primary transition-all">
                                                    <div class="bg-gray-100 p-3">
                                                        <div class="h-24 rounded-md border border-base-light/20 bg-gray-800 flex flex-col">
                                                            <div class="h-4 bg-gray-900 border-b border-gray-700 mb-1"></div>
                                                            <div class="flex-1 p-2">
                                                                <div class="w-12 h-2 bg-gray-700 rounded mb-1"></div>
                                                                <div class="w-20 h-2 bg-gray-700 rounded"></div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 text-center text-sm font-medium text-base-dark">Dark</div>
                                                    </div>
                                                </div>
                                            </label>
                                            
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="theme" value="system" class="sr-only peer" onchange="applyThemeMode('system')">
                                                <div class="overflow-hidden rounded-lg border-2 border-base-light/30 peer-checked:border-primary transition-all">
                                                    <div class="bg-gray-100 p-3">
                                                        <div class="h-24 rounded-md border border-base-light/20 bg-gradient-to-r from-white to-gray-800 flex flex-col">
                                                            <div class="h-4 bg-gradient-to-r from-white to-gray-900 border-b border-base-light/20 mb-1"></div>
                                                            <div class="flex-1 p-2">
                                                                <div class="w-12 h-2 bg-base-light/20 rounded mb-1"></div>
                                                                <div class="w-20 h-2 bg-base-light/20 rounded"></div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 text-center text-sm font-medium text-base-dark">System</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <p class="mt-2 text-sm text-base-light">System follows your device's dark/light mode settings.</p>
                                    </div>

                                    <!-- Color Customization -->
                                    <div>
                                        <label class="block text-sm font-medium text-base-dark mb-3">Color Customization</label>
                                        
                                        <!-- Live Preview -->
                                        <div class="mb-5 p-4 rounded-lg border border-base-light/30 bg-white">
                                            <div class="text-xs uppercase text-base-light tracking-wider mb-3">Preview</div>
                                            <div class="flex flex-wrap gap-2">
                                                <div class="preview-primary h-10 w-16 rounded flex items-center justify-center text-white text-xs font-medium">Primary</div>
                                                <div class="preview-secondary h-10 w-16 rounded flex items-center justify-center text-white text-xs font-medium">Secondary</div>
                                                <div class="preview-accent h-10 w-16 rounded flex items-center justify-center text-white text-xs font-medium">Accent</div>
                                                <div class="preview-base h-10 w-16 rounded flex items-center justify-center text-white text-xs font-medium">Base</div>
                                            </div>
                                            <div class="flex flex-wrap gap-2 mt-2">
                                                <button type="button" class="preview-btn-primary px-3 py-1.5 text-xs font-medium rounded">Primary Button</button>
                                                <button type="button" class="preview-btn-secondary px-3 py-1.5 text-xs font-medium rounded">Secondary Button</button>
                                                <button type="button" class="preview-btn-accent px-3 py-1.5 text-xs font-medium rounded">Accent Button</button>
                                            </div>
                                        </div>
                                        
                                        <!-- Color Pickers -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                            <!-- Primary Color -->
                                            <div>
                                                <label for="primary_color" class="block text-sm font-medium text-base-dark mb-1">Primary Color</label>
                                                <div class="flex items-center">
                                                    <input type="color" id="primary_color" name="primary_color" value="#4f46e5" 
                                                        class="w-10 h-10 rounded-md border-0 p-0 cursor-pointer"
                                                        oninput="updatePreview('primary', this.value)">
                                                    <input type="text" 
                                                        id="primary_color_hex" 
                                                        name="primary_color_hex" 
                                                        value="#4f46e5" 
                                                        class="ml-2 p-2 w-full rounded-md border-base-light/30 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                                        onchange="updateColorInput('primary_color', this.value); updatePreview('primary', this.value)">
                                                </div>
                                                <p class="mt-1 text-sm text-base-light">Used for buttons, links, and primary actions.</p>
                                            </div>
                                            
                                            <!-- Secondary Color -->
                                            <div>
                                                <label for="secondary_color" class="block text-sm font-medium text-base-dark mb-1">Secondary Color</label>
                                                <div class="flex items-center">
                                                    <input type="color" id="secondary_color" name="secondary_color" value="#475569" 
                                                        class="w-10 h-10 rounded-md border-0 p-0 cursor-pointer"
                                                        oninput="updatePreview('secondary', this.value)">
                                                    <input type="text" 
                                                        id="secondary_color_hex" 
                                                        name="secondary_color_hex" 
                                                        value="#475569" 
                                                        class="ml-2 p-2 w-full rounded-md border-base-light/30 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                                        onchange="updateColorInput('secondary_color', this.value); updatePreview('secondary', this.value)">
                                                </div>
                                                <p class="mt-1 text-sm text-base-light">Used for secondary buttons and accents.</p>
                                            </div>
                                            
                                            <!-- Accent Color -->
                                            <div>
                                                <label for="accent_color" class="block text-sm font-medium text-base-dark mb-1">Accent Color</label>
                                                <div class="flex items-center">
                                                    <input type="color" id="accent_color" name="accent_color" value="#0ea5e9" 
                                                        class="w-10 h-10 rounded-md border-0 p-0 cursor-pointer"
                                                        oninput="updatePreview('accent', this.value)">
                                                    <input type="text" 
                                                        id="accent_color_hex" 
                                                        name="accent_color_hex" 
                                                        value="#0ea5e9" 
                                                        class="ml-2 p-2 w-full rounded-md border-base-light/30 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                                        onchange="updateColorInput('accent_color', this.value); updatePreview('accent', this.value)">
                                                </div>
                                                <p class="mt-1 text-sm text-base-light">Highlights and special elements.</p>
                                            </div>
                                            
                                            <!-- Base Color -->
                                            <div>
                                                <label for="base_color" class="block text-sm font-medium text-base-dark mb-1">Base Color</label>
                                                <div class="flex items-center">
                                                    <input type="color" id="base_color" name="base_color" value="#111827" 
                                                        class="w-10 h-10 rounded-md border-0 p-0 cursor-pointer"
                                                        oninput="updatePreview('base', this.value)">
                                                    <input type="text" 
                                                        id="base_color_hex" 
                                                        name="base_color_hex" 
                                                        value="#111827" 
                                                        class="ml-2 p-2 w-full rounded-md border-base-light/30 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                                        onchange="updateColorInput('base_color', this.value); updatePreview('base', this.value)">
                                                </div>
                                                <p class="mt-1 text-sm text-base-light">Used for text and neutral UI elements.</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Color Presets -->
                                        <div class="mt-4">
                                            <label class="block text-sm font-medium text-base-dark mb-2">Preset Themes</label>
                                            <div class="flex flex-wrap gap-2">
                                                <button type="button" onclick="applyPreset('laravel')" class="h-8 w-8 rounded-full bg-red-600 border-2 border-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" title="Laravel 12"></button>
                                                <button type="button" onclick="applyPreset('default')" class="h-8 w-8 rounded-full bg-indigo-600 border-2 border-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" title="Default"></button>
                                                <button type="button" onclick="applyPreset('blue')" class="h-8 w-8 rounded-full bg-blue-600 border-2 border-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" title="Blue"></button>
                                                <button type="button" onclick="applyPreset('emerald')" class="h-8 w-8 rounded-full bg-emerald-600 border-2 border-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500" title="Emerald"></button>
                                                <button type="button" onclick="applyPreset('amber')" class="h-8 w-8 rounded-full bg-amber-600 border-2 border-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500" title="Amber"></button>
                                                <button type="button" onclick="applyPreset('rose')" class="h-8 w-8 rounded-full bg-rose-600 border-2 border-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500" title="Rose"></button>
                                                <button type="button" onclick="applyPreset('purple')" class="h-8 w-8 rounded-full bg-purple-600 border-2 border-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" title="Purple"></button>
                                                <button type="button" onclick="applyPreset('neutral')" class="h-8 w-8 rounded-full bg-gray-700 border-2 border-white shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" title="Neutral"></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional UI Options -->
                                    <div class="space-y-3">
                                        <label class="block text-sm font-medium text-base-dark">Additional Options</label>
                                        
                                        <div>
                                            <label for="sidebar" class="flex items-center text-sm text-base-dark">
                                                <input id="sidebar" name="sidebar" type="checkbox" class="h-4 w-4 rounded border-base-light/30 text-primary focus:ring-primary" onchange="updateSetting('sidebarCollapsed', this.checked)">
                                                <span class="ml-2">Collapsed sidebar by default</span>
                                            </label>
                                        </div>
                                        
                                        <div>
                                            <label for="animations" class="flex items-center text-sm text-base-dark">
                                                <input id="animations" name="animations" type="checkbox" class="h-4 w-4 rounded border-base-light/30 text-primary focus:ring-primary" checked onchange="updateSetting('animations', this.checked)">
                                                <span class="ml-2">Enable animations and transitions</span>
                                            </label>
                                        </div>
                                        
                                        <div>
                                            <label for="contrast" class="flex items-center text-sm text-base-dark">
                                                <input id="contrast" name="contrast" type="checkbox" class="h-4 w-4 rounded border-base-light/30 text-primary focus:ring-primary" onchange="updateSetting('highContrast', this.checked)">
                                                <span class="ml-2">High contrast mode</span>
                                            </label>
                                        </div>
                                        
                                        <div>
                                            <label for="reduced_motion" class="flex items-center text-sm text-base-dark">
                                                <input id="reduced_motion" name="reduced_motion" type="checkbox" class="h-4 w-4 rounded border-base-light/30 text-primary focus:ring-primary" onchange="updateSetting('reducedMotion', this.checked)">
                                                <span class="ml-2">Reduced motion</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        Save Appearance
                                    </button>
                                    <button type="button" onclick="resetToDefaults()" class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-base-dark bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        Reset to Defaults
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
                                        value="Laravel 12 Boilerplate"
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

    <script>
        // Theme settings object
        const themeSettings = {
            mode: 'light',
            colors: {
                primary: '#ff2d20', // Laravel red as default
                secondary: '#2d3748',
                accent: '#38bdf8',
                base: '#1a202c'
            },
            options: {
                sidebarCollapsed: false,
                animations: true,
                highContrast: false,
                reducedMotion: false
            }
        };

        // Initialize preview on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Load saved settings or use defaults
            loadSavedSettings();
            
            // Initialize color previews
            updatePreview('primary', document.getElementById('primary_color').value);
            updatePreview('secondary', document.getElementById('secondary_color').value);
            updatePreview('accent', document.getElementById('accent_color').value);
            updatePreview('base', document.getElementById('base_color').value);
            
            // Apply current theme
            applyTheme();
        });
        
        // Load settings from localStorage
        function loadSavedSettings() {
            const savedSettings = localStorage.getItem('appThemeSettings');
            if (savedSettings) {
                const parsedSettings = JSON.parse(savedSettings);
                
                // Merge saved settings with defaults
                themeSettings.mode = parsedSettings.mode || 'light';
                themeSettings.colors = { ...themeSettings.colors, ...parsedSettings.colors };
                themeSettings.options = { ...themeSettings.options, ...parsedSettings.options };
                
                // Update UI to reflect loaded settings
                document.querySelector(`input[name="theme"][value="${themeSettings.mode}"]`).checked = true;
                
                document.getElementById('primary_color').value = themeSettings.colors.primary;
                document.getElementById('primary_color_hex').value = themeSettings.colors.primary;
                
                document.getElementById('secondary_color').value = themeSettings.colors.secondary;
                document.getElementById('secondary_color_hex').value = themeSettings.colors.secondary;
                
                document.getElementById('accent_color').value = themeSettings.colors.accent;
                document.getElementById('accent_color_hex').value = themeSettings.colors.accent;
                
                document.getElementById('base_color').value = themeSettings.colors.base;
                document.getElementById('base_color_hex').value = themeSettings.colors.base;
                
                document.getElementById('sidebar').checked = themeSettings.options.sidebarCollapsed;
                document.getElementById('animations').checked = themeSettings.options.animations;
                document.getElementById('contrast').checked = themeSettings.options.highContrast;
                document.getElementById('reduced_motion').checked = themeSettings.options.reducedMotion;
            }
        }
        
        // Save settings to localStorage
        function saveSettings() {
            localStorage.setItem('appThemeSettings', JSON.stringify(themeSettings));
        }
        
        // Update preview elements with selected colors
        function updatePreview(type, color) {
            document.querySelector(`.preview-${type}`).style.backgroundColor = color;
            
            if (type === 'primary') {
                document.querySelector(`.preview-btn-primary`).style.backgroundColor = color;
                document.querySelector(`.preview-btn-primary`).style.color = '#ffffff';
                themeSettings.colors.primary = color;
            } else if (type === 'secondary') {
                document.querySelector(`.preview-btn-secondary`).style.backgroundColor = color;
                document.querySelector(`.preview-btn-secondary`).style.color = '#ffffff';
                themeSettings.colors.secondary = color;
            } else if (type === 'accent') {
                document.querySelector(`.preview-btn-accent`).style.backgroundColor = color;
                document.querySelector(`.preview-btn-accent`).style.color = '#ffffff';
                themeSettings.colors.accent = color;
            } else if (type === 'base') {
                themeSettings.colors.base = color;
            }
            
            // Update text input
            document.getElementById(`${type}_color_hex`).value = color;
            
            // Apply the color change immediately
            applyTheme();
            
            // Save settings
            saveSettings();
        }
        
        // Update color input from text field
        function updateColorInput(inputId, value) {
            document.getElementById(inputId).value = value;
        }
        
        // Apply preset color themes
        function applyPreset(preset) {
            let primary, secondary, accent, base;
            
            switch(preset) {
                case 'laravel':
                    primary = '#ff2d20';  // Laravel red
                    secondary = '#2d3748'; // Laravel dark blue/gray
                    accent = '#38bdf8';   // Laravel blue accent
                    base = '#1a202c';     // Dark text color
                    break;
                case 'default':
                    primary = '#4f46e5';
                    secondary = '#475569';
                    accent = '#0ea5e9';
                    base = '#111827';
                    break;
                case 'blue':
                    primary = '#2563eb';
                    secondary = '#475569';
                    accent = '#06b6d4';
                    base = '#111827';
                    break;
                case 'emerald':
                    primary = '#059669';
                    secondary = '#475569';
                    accent = '#0ea5e9';
                    base = '#111827';
                    break;
                case 'amber':
                    primary = '#d97706';
                    secondary = '#475569';
                    accent = '#0369a1';
                    base = '#111827';
                    break;
                case 'rose':
                    primary = '#e11d48';
                    secondary = '#475569';
                    accent = '#0ea5e9';
                    base = '#111827';
                    break;
                case 'purple':
                    primary = '#9333ea';
                    secondary = '#475569';
                    accent = '#2dd4bf';
                    base = '#111827';
                    break;
                case 'neutral':
                    primary = '#525252';
                    secondary = '#737373';
                    accent = '#0ea5e9';
                    base = '#171717';
                    break;
            }
            
            // Update color inputs
            document.getElementById('primary_color').value = primary;
            document.getElementById('secondary_color').value = secondary;
            document.getElementById('accent_color').value = accent;
            document.getElementById('base_color').value = base;
            
            // Update theme settings
            themeSettings.colors.primary = primary;
            themeSettings.colors.secondary = secondary;
            themeSettings.colors.accent = accent;
            themeSettings.colors.base = base;
            
            // Update previews
            updatePreview('primary', primary);
            updatePreview('secondary', secondary);
            updatePreview('accent', accent);
            updatePreview('base', base);
            
            // Apply the theme
            applyTheme();
            
            // Save settings
            saveSettings();
        }
        
        // Apply theme mode (light, dark, system)
        function applyThemeMode(mode) {
            themeSettings.mode = mode;
            applyTheme();
            saveSettings();
        }
        
        // Update a specific setting
        function updateSetting(setting, value) {
            themeSettings.options[setting] = value;
            applyTheme();
            saveSettings();
        }
        
        // Apply the theme to the document
        function applyTheme() {
            const root = document.documentElement;
            const { colors, mode, options } = themeSettings;
            
            // Convert hex to RGB for CSS variables
            const hexToRgb = (hex) => {
                const shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
                hex = hex.replace(shorthandRegex, (m, r, g, b) => r + r + g + g + b + b);
                
                const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                return result ? {
                    r: parseInt(result[1], 16),
                    g: parseInt(result[2], 16),
                    b: parseInt(result[3], 16)
                } : null;
            };
            
            // Set color CSS variables
            const primaryRgb = hexToRgb(colors.primary);
            const secondaryRgb = hexToRgb(colors.secondary);
            const accentRgb = hexToRgb(colors.accent);
            const baseRgb = hexToRgb(colors.base);
            
            if (primaryRgb) {
                root.style.setProperty('--color-primary', colors.primary);
                root.style.setProperty('--primary-color', colors.primary);
                root.style.setProperty('--primary-rgb', `${primaryRgb.r}, ${primaryRgb.g}, ${primaryRgb.b}`);
            }
            
            if (secondaryRgb) {
                root.style.setProperty('--color-secondary', colors.secondary);
                root.style.setProperty('--secondary-color', colors.secondary);
                root.style.setProperty('--secondary-rgb', `${secondaryRgb.r}, ${secondaryRgb.g}, ${secondaryRgb.b}`);
            }
            
            if (accentRgb) {
                root.style.setProperty('--color-accent', colors.accent);
                root.style.setProperty('--accent-color', colors.accent);
                root.style.setProperty('--accent-rgb', `${accentRgb.r}, ${accentRgb.g}, ${accentRgb.b}`);
            }
            
            if (baseRgb) {
                root.style.setProperty('--color-base', colors.base);
                root.style.setProperty('--base-color', colors.base);
                root.style.setProperty('--base-rgb', `${baseRgb.r}, ${baseRgb.g}, ${baseRgb.b}`);
            }
            
            // Apply theme mode
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = mode === 'dark' || (mode === 'system' && prefersDark);
            
            if (isDark) {
                document.body.classList.add('dark-mode');
                root.style.setProperty('--color-background', '#1a202c');
                root.style.setProperty('--background-color', '#1a202c');
            } else {
                document.body.classList.remove('dark-mode');
                root.style.setProperty('--color-background', '#f8fafc');
                root.style.setProperty('--background-color', '#f8fafc');
            }
            
            // Apply additional options
            if (options.highContrast) {
                document.body.classList.add('high-contrast');
            } else {
                document.body.classList.remove('high-contrast');
            }
            
            if (options.reducedMotion) {
                document.body.classList.add('reduced-motion');
            } else {
                document.body.classList.remove('reduced-motion');
            }
            
            // Apply animations setting
            if (!options.animations) {
                root.style.setProperty('--transition-speed', '0s');
            } else {
                root.style.setProperty('--transition-speed', '0.2s');
            }
            
            // Apply sidebar setting (this might need additional logic elsewhere)
            if (options.sidebarCollapsed) {
                document.body.classList.add('sidebar-collapsed');
            } else {
                document.body.classList.remove('sidebar-collapsed');
            }
        }
        
        // Reset to default values
        function resetToDefaults() {
            // Reset theme settings to defaults
            themeSettings.mode = 'light';
            themeSettings.colors = {
                primary: '#ff2d20', // Laravel red
                secondary: '#2d3748',
                accent: '#38bdf8',
                base: '#1a202c'
            };
            themeSettings.options = {
                sidebarCollapsed: false,
                animations: true,
                highContrast: false,
                reducedMotion: false
            };
            
            // Update UI
            document.querySelector('input[name="theme"][value="light"]').checked = true;
            document.getElementById('animations').checked = true;
            document.getElementById('sidebar').checked = false;
            document.getElementById('contrast').checked = false;
            document.getElementById('reduced_motion').checked = false;
            
            // Apply preset colors
            applyPreset('laravel'); // Set Laravel preset as default
            
            // Save settings
            saveSettings();
            
            // Show toast notification
            showToast('Settings reset to defaults', 'success');
        }
        
        // Show toast notification
        function showToast(message, type = 'info') {
            const toastContainer = document.getElementById('toast-container');
            if (!toastContainer) return;
            
            const toast = document.createElement('div');
            toast.className = `toast-enter px-4 py-3 rounded shadow-lg flex items-center mb-2 ${type === 'success' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'}`;
            
            const icon = type === 'success' 
                ? '<svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>'
                : '<svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
            
            toast.innerHTML = icon + message;
            
            toastContainer.appendChild(toast);
            
            setTimeout(() => {
                toast.classList.replace('toast-enter', 'toast-exit');
                setTimeout(() => {
                    toastContainer.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Listen for system dark mode changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (themeSettings.mode === 'system') {
                applyTheme();
            }
        });
    </script>
</x-app-layout>
