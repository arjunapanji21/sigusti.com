@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Profile Settings</h2>
            <p class="mt-1 text-sm text-gray-600">Update your account information</p>
        </div>
        
        <form method="POST" action="{{ route('profile.update') }}" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" 
                                 type="text"
                                 name="name" 
                                 :value="old('name', auth()->user()->name)"
                                 class="mt-1 block w-full" 
                                 required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" 
                                 type="email"
                                 name="email" 
                                 :value="old('email', auth()->user()->email)"
                                 class="mt-1 block w-full"
                                 disabled 
                                 required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="phone" :value="__('Phone (optional)')" />
                    <x-text-input id="phone" 
                                 type="tel"
                                 name="phone" 
                                 :value="old('phone', auth()->user()->phone)"
                                 class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-6 bg-white shadow rounded-lg">
        <div class="p-6 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Account Security</h3>
                <p class="mt-1 text-sm text-gray-600">Update your password or delete your account</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('profile.change-password') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Change Password
                </a>
                <a href="{{ route('profile.delete') }}" 
                   class="inline-flex items-center px-4 py-2 border border-red-300 rounded-md text-sm font-medium text-red-700 hover:bg-red-50">
                    Delete Account
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
