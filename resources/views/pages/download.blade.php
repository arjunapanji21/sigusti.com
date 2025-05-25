@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-4">Download Software</h1>
            <div class="space-y-6">
                @if(auth()->user()->hasValidLicense())
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h2 class="text-xl font-semibold mb-2">Latest Version (v1.0.0)</h2>
                        <p class="text-gray-600 mb-4">Download the latest version of our software.</p>
                        <div class="flex flex-col space-y-2">
                            <div class="text-sm text-gray-500 mb-2">
                                <span class="font-medium">File Size:</span> 45.2 MB
                                <span class="mx-2">|</span>
                                <span class="font-medium">Released:</span> {{ now()->format('M d, Y') }}
                            </div>
                            <a href="{{ route('download.file') }}" 
                               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg inline-flex items-center w-fit">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Download Now
                            </a>
                        </div>
                    </div>
                @else
                    <div class="p-4 bg-yellow-50 border border-yellow-100 rounded-lg">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-yellow-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <h3 class="text-sm font-medium text-yellow-800">Valid License Required</h3>
                        </div>
                        <p class="mt-2 text-sm text-yellow-700">You need an active license to download the software. Please purchase a license or renew your existing one.</p>
                        <div class="mt-4">
                            <a href="{{ route('payments.create') }}" class="text-yellow-800 hover:text-yellow-900 font-medium">
                                Get License →
                            </a>
                        </div>
                    </div>
                @endif
                
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
