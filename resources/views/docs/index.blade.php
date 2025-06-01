<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-semibold text-base-dark mb-6">Documentation</h1>
                    
                    <!-- Table of Contents -->
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-medium text-base-dark mb-2">Contents</h3>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                            <li><a href="#getting-started" class="text-primary hover:text-primary-dark">Getting Started</a></li>
                            <li><a href="#features" class="text-primary hover:text-primary-dark">Features</a></li>
                            <li><a href="#installation" class="text-primary hover:text-primary-dark">Installation</a></li>
                            <li><a href="#configuration" class="text-primary hover:text-primary-dark">Configuration</a></li>
                            <li><a href="#architecture" class="text-primary hover:text-primary-dark">Architecture</a></li>
                            <li><a href="#customization" class="text-primary hover:text-primary-dark">Customization</a></li>
                        </ul>
                    </div>
                    
                    <div class="prose max-w-none">
                        <h2 id="getting-started" class="flex items-center text-xl font-semibold mt-8 pb-2 border-b border-gray-200">
                            <svg class="h-6 w-6 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Getting Started
                        </h2>
                        <p>Welcome to Laravel 12 Boilerplate documentation. This boilerplate is designed to accelerate your Laravel application development with pre-built features and components.</p>
                        
                        <h3 id="features" class="flex items-center text-lg font-medium mt-6">
                            <svg class="h-5 w-5 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Features
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 mt-3">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-5 w-5 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="ml-2">Complete authentication system</span>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-5 w-5 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="ml-2">Intuitive role-based user management with admin privileges</span>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-5 w-5 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="ml-2">Personalized profile settings with user-friendly visual interfaces</span>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-5 w-5 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="ml-2">Powerful app settings with dynamic theme control and personalization</span>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-5 w-5 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="ml-2">Sleek, mobile-first UI built with Tailwind CSS 4 for optimal experiences</span>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-5 w-5 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="ml-2">Interactive UI components with Alpine.js and dynamic features</span>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-5 w-5 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="ml-2">Accessibility features including high contrast mode and reduced motion</span>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-5 w-5 text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="ml-2">Modern middleware architecture using Laravel 12's new approach</span>
                            </div>
                        </div>
                        
                        <h3 id="installation" class="flex items-center text-lg font-medium mt-6">
                            <svg class="h-5 w-5 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Installation
                        </h3>
                        <p>To install this boilerplate, follow these steps:</p>
                        
                        <div class="bg-gray-800 text-white rounded-lg overflow-hidden mt-4">
                            <div class="flex items-center justify-between px-4 py-2 bg-gray-900">
                                <span class="text-xs font-semibold">Terminal</span>
                                <div class="flex space-x-1">
                                    <div class="h-3 w-3 rounded-full bg-red-500"></div>
                                    <div class="h-3 w-3 rounded-full bg-yellow-500"></div>
                                    <div class="h-3 w-3 rounded-full bg-green-500"></div>
                                </div>
                            </div>
                            <div class="p-4 text-sm overflow-x-auto">
                                <pre class="language-bash"><code># Clone the repository
git clone https://github.com/arjunapanji21/laravel12-boilerplate.git

# Navigate to the project directory
cd laravel12-boilerplate

# Install PHP dependencies
composer install

# Install frontend dependencies
npm install

# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Build frontend assets
npm run dev</code></pre>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 mb-4 mt-6 text-blue-800 bg-blue-50 rounded-lg" role="alert">
                            <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2h.01a1 1 0 000-2H9z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="ml-3 text-sm">
                                Make sure you have <a href="https://getcomposer.org/" class="font-medium hover:underline">Composer</a>, <a href="https://nodejs.org/" class="font-medium hover:underline">Node.js</a>, and <a href="https://www.php.net/" class="font-medium hover:underline">PHP >= 8.1</a> installed on your system.
                            </div>
                        </div>

                        <h3 id="configuration" class="flex items-center text-lg font-medium mt-6">
                            <svg class="h-5 w-5 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M3 12h18m-7 6h7" />
                            </svg>
                            Configuration
                        </h3>
                        <p>After installation, you can configure your application by editing the .env file and using the Settings page in the admin dashboard.</p>
                        
                        <h2 id="architecture" class="flex items-center text-xl font-semibold mt-8 pb-2 border-b border-gray-200">
                            <svg class="h-6 w-6 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Architecture
                        </h2>
                        <p>This boilerplate follows Laravel's MVC architecture with some additional organization for larger applications:</p>
                        
                        <ul class="mt-4 space-y-3 list-none">
                            <li class="flex items-start">
                                <span class="flex-shrink-0 h-5 w-5 text-primary mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span><strong class="font-semibold text-base-dark">Controllers:</strong> Located in app/Http/Controllers for handling requests and responses</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 h-5 w-5 text-primary mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span><strong class="font-semibold text-base-dark">Models:</strong> Located in app/Models for database interaction and business logic</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 h-5 w-5 text-primary mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span><strong class="font-semibold text-base-dark">Views:</strong> Located in resources/views for rendering UI components and templates</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 h-5 w-5 text-primary mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span><strong class="font-semibold text-base-dark">Routes:</strong> Defined in routes/web.php and routes/api.php for mapping URLs to controllers</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 h-5 w-5 text-primary mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span><strong class="font-semibold text-base-dark">Middleware:</strong> Located in app/Http/Middleware for filtering HTTP requests</span>
                            </li>
                        </ul>
                        
                        <h2 id="customization" class="flex items-center text-xl font-semibold mt-8 pb-2 border-b border-gray-200">
                            <svg class="h-6 w-6 text-primary mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Customization
                        </h2>
                        <p>This boilerplate is designed to be easily customizable:</p>
                        
                        <h3>UI Customization</h3>
                        <p>The UI is built with Tailwind CSS. You can customize the theme by editing the tailwind.config.js file.</p>
                        
                        <h3>Adding New Features</h3>
                        <p>To add new features, follow these steps:</p>
                        <ol class="mt-4 space-y-3 list-none pl-0">
                            <li class="flex items-start">
                                <span class="flex-shrink-0 bg-primary text-white rounded-full h-6 w-6 flex items-center justify-center mr-3 font-semibold text-sm">1</span>
                                <span>Create controller(s) in <code class="px-2 py-1 bg-gray-100 rounded text-sm font-mono">app/Http/Controllers</code></span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 bg-primary text-white rounded-full h-6 w-6 flex items-center justify-center mr-3 font-semibold text-sm">2</span>
                                <span>Create model(s) in <code class="px-2 py-1 bg-gray-100 rounded text-sm font-mono">app/Models</code> if needed</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 bg-primary text-white rounded-full h-6 w-6 flex items-center justify-center mr-3 font-semibold text-sm">3</span>
                                <span>Create migration(s) if you need new database tables</span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 bg-primary text-white rounded-full h-6 w-6 flex items-center justify-center mr-3 font-semibold text-sm">4</span>
                                <span>Create view(s) in <code class="px-2 py-1 bg-gray-100 rounded text-sm font-mono">resources/views</code></span>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 bg-primary text-white rounded-full h-6 w-6 flex items-center justify-center mr-3 font-semibold text-sm">5</span>
                                <span>Add routes in <code class="px-2 py-1 bg-gray-100 rounded text-sm font-mono">routes/web.php</code></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
