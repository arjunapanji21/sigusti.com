<x-app-layout>
    <div class="space-y-6">
        <!-- Current Subscription -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Current Subscription</h2>
            @if(auth()->user()->subscription)
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-900">{{ auth()->user()->subscription->plan->name }}</p>
                            <p class="text-sm text-gray-500">Valid until: {{ auth()->user()->subscription->expires_at->format('d M Y') }}</p>
                        </div>
                        @if(auth()->user()->subscription->isExpiringSoon())
                            <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Renew Plan
                            </button>
                        @endif
                    </div>
                </div>
            @else
                <p class="text-gray-500">You don't have an active subscription.</p>
            @endif
        </div>

        <!-- Available Plans -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Available Plans</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($plans as $plan)
                    <div class="border rounded-lg p-6 space-y-4">
                        <h3 class="text-lg font-medium">{{ $plan->name }}</h3>
                        <p class="text-3xl font-bold">${{ $plan->price }}</p>
                        <ul class="space-y-2">
                            @foreach($plan->features as $feature)
                                <li class="flex items-center">
                                    <x-icon name="check" class="h-5 w-5 text-green-500 mr-2"/>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <button 
                            @if(auth()->user()->subscription && auth()->user()->subscription->plan_id === $plan->id)
                                disabled
                                class="w-full bg-gray-300 text-gray-600 px-4 py-2 rounded-md cursor-not-allowed"
                            @else
                                class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700"
                            @endif
                        >
                            @if(auth()->user()->subscription && auth()->user()->subscription->plan_id === $plan->id)
                                Current Plan
                            @else
                                {{ auth()->user()->subscription ? 'Upgrade' : 'Subscribe' }}
                            @endif
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
