<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-semibold text-base-dark mb-6">Searchable Select Demo</h1>
                    
                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Basic example -->
                        <x-select-searchable
                            name="country"
                            label="Country"
                            placeholder="Select your country"
                            :options="[
                                ['value' => 'us', 'label' => 'United States', 'icon' => '<svg class=\"h-5 w-5 text-blue-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\"></path></svg>'],
                                ['value' => 'ca', 'label' => 'Canada', 'icon' => '<svg class=\"h-5 w-5 text-red-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\"></path></svg>'],
                                ['value' => 'mx', 'label' => 'Mexico', 'icon' => '<svg class=\"h-5 w-5 text-green-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\"></path></svg>'],
                                ['value' => 'uk', 'label' => 'United Kingdom', 'icon' => '<svg class=\"h-5 w-5 text-purple-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\"></path></svg>'],
                                ['value' => 'fr', 'label' => 'France', 'icon' => '<svg class=\"h-5 w-5 text-blue-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\"></path></svg>'],
                                ['value' => 'de', 'label' => 'Germany', 'icon' => '<svg class=\"h-5 w-5 text-yellow-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\"></path></svg>'],
                                ['value' => 'jp', 'label' => 'Japan', 'icon' => '<svg class=\"h-5 w-5 text-red-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\"></path></svg>'],
                                ['value' => 'au', 'label' => 'Australia', 'icon' => '<svg class=\"h-5 w-5 text-green-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\"></path></svg>'],
                                ['value' => 'br', 'label' => 'Brazil', 'icon' => '<svg class=\"h-5 w-5 text-yellow-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\"></path></svg>'],
                                ['value' => 'in', 'label' => 'India', 'icon' => '<svg class=\"h-5 w-5 text-orange-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\"></path></svg>'],
                                ['value' => 'cn', 'label' => 'China', 'icon' => '<svg class=\"h-5 w-5 text-red-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9\"></path></svg>'],
                            ]"
                            helper="Select the country where you currently reside"
                        />
                        
                        <!-- Example with preselected value -->
                        <x-select-searchable
                            name="language"
                            label="Preferred Language"
                            placeholder="Select a language"
                            :options="[
                                ['value' => 'en', 'label' => 'English'],
                                ['value' => 'es', 'label' => 'Spanish'],
                                ['value' => 'fr', 'label' => 'French'],
                                ['value' => 'de', 'label' => 'German'],
                                ['value' => 'it', 'label' => 'Italian'],
                                ['value' => 'pt', 'label' => 'Portuguese'],
                                ['value' => 'ru', 'label' => 'Russian'],
                                ['value' => 'zh', 'label' => 'Chinese'],
                                ['value' => 'ja', 'label' => 'Japanese'],
                                ['value' => 'ar', 'label' => 'Arabic'],
                            ]"
                            selected="en"
                            required
                        />
                        
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
