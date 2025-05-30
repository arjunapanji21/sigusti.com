@extends('layouts.guest')
@section('content')
<div class="mt-16 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-8">Privacy Policy</h1>
                
                <div class="prose max-w-none">
                    <h2 class="text-xl font-semibold text-gray-900">1. Information We Collect</h2>
                    <p>To provide and improve Auto WhatsApp Web services, we collect:</p>
                    <h3 class="text-lg font-medium text-gray-800 mt-4">1.1 Account Information</h3>
                    <ul class="list-disc pl-6 mt-2 space-y-2">
                        <li>Name and email address</li>
                        <li>Contact information</li>
                        <li>Business details (if applicable)</li>
                        <li>Login credentials</li>
                    </ul>

                    <h3 class="text-lg font-medium text-gray-800 mt-4">1.2 Usage Data</h3>
                    <ul class="list-disc pl-6 mt-2 space-y-2">
                        <li>Message statistics and patterns</li>
                        <li>Feature usage analytics</li>
                        <li>Performance metrics</li>
                        <li>Error logs and crash reports</li>
                    </ul>

                    <h2 class="text-xl font-semibold text-gray-900 mt-8">2. How We Use Your Information</h2>
                    <p>autowhatsapp.web.id uses collected data to:</p>
                    <ul class="list-disc pl-6 mt-4 space-y-2">
                        <li>Provide and maintain our services</li>
                        <li>Monitor and prevent abuse</li>
                        <li>Process payments and manage subscriptions</li>
                        <li>Improve our products and user experience</li>
                        <li>Communicate service updates</li>
                    </ul>

                    <h2 class="text-xl font-semibold text-gray-900 mt-8">3. Data Security</h2>
                    <p>We implement industry-standard security measures including:</p>
                    <ul class="list-disc pl-6 mt-4 space-y-2">
                        <li>End-to-end encryption for sensitive data</li>
                        <li>Regular security audits and updates</li>
                        <li>Secure data storage and transmission</li>
                        <li>Access controls and authentication</li>
                    </ul>

                    <h2 class="text-xl font-semibold text-gray-900 mt-8">4. Data Retention</h2>
                    <p>We retain your information only for as long as necessary to:</p>
                    <ul class="list-disc pl-6 mt-4 space-y-2">
                        <li>Provide our services to you</li>
                        <li>Comply with legal obligations</li>
                        <li>Resolve disputes</li>
                        <li>Enforce our agreements</li>
                    </ul>

                    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-600">Last updated: {{date('F d, Y')}}</p>
                        <p class="text-sm text-gray-600 mt-2">Contact: privacy@autowhatsapp.web.id</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection