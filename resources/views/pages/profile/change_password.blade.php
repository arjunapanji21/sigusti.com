@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Change Password</h2>
            <p class="mt-1 text-sm text-gray-600">Ensure your account is using a secure password</p>
        </div>
        
        <form method="POST" action="{{ route('profile.change-password') }}" class="p-6">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <x-input-label for="current_password" :value="__('Current Password')" />
                    <x-text-input id="current_password" 
                                 type="password"
                                 name="current_password" 
                                 class="mt-1 block w-full"
                                 required />
                    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('New Password')" />
                    <x-text-input id="password" 
                                 type="password"
                                 name="password" 
                                 class="mt-1 block w-full"
                                 required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" 
                                 type="password"
                                 name="password_confirmation" 
                                 class="mt-1 block w-full"
                                 required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('profile.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Back to Profile
                    </a>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                        Change Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
