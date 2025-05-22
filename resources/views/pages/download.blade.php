@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-4">Download Software</h1>
            <div class="space-y-6">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <h2 class="text-xl font-semibold mb-2">Latest Version</h2>
                    <p class="text-gray-600 mb-4">Download the latest version of our software.</p>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download Now
                    </button>
                </div>
                
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">System Requirements</h3>
                    <ul class="list-disc list-inside text-gray-600">
                        <li>Windows 10 or later</li>
                        <li>4GB RAM minimum</li>
                        <li>500MB free disk space</li>
                        <li>Internet connection</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
