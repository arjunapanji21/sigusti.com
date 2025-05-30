@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-red-600">Delete Account</h2>
            <p class="mt-1 text-sm text-gray-600">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
        </div>
        
        <form method="POST" action="{{ route('profile.delete') }}" class="p-6">
            @csrf
            @method('DELETE')
            
            <div class="space-y-6">
                <div>
                    <x-input-label for="password" :value="__('Please enter your password to confirm you would like to delete your account')" />
                    <x-text-input id="password" 
                                 type="password"
                                 name="password" 
                                 class="mt-1 block w-full"
                                 required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                
                <div class="flex items-center justify-between">
                    <a href="{{ route('profile.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Back to Profile
                    </a>
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700"
                            onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                        Delete Account
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
