@if (session('success'))
    <div class="rounded-md bg-green-50 p-4 mb-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <x-icon name="check-circle" class="h-5 w-5 text-green-400"/>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="rounded-md bg-red-50 p-4 mb-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <x-icon name="x-circle" class="h-5 w-5 text-red-400"/>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-red-800">
                    {{ session('error') }}
                </p>
            </div>
        </div>
    </div>
@endif

@if (session('warning'))
    <div class="rounded-md bg-yellow-50 p-4 mb-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <x-icon name="exclamation" class="h-5 w-5 text-yellow-400"/>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-yellow-800">
                    {{ session('warning') }}
                </p>
            </div>
        </div>
    </div>
@endif

@if (session('info'))
    <div class="rounded-md bg-blue-50 p-4 mb-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <x-icon name="information-circle" class="h-5 w-5 text-blue-400"/>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-blue-800">
                    {{ session('info') }}
                </p>
            </div>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="rounded-md bg-red-50 p-4 mb-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <x-icon name="x-circle" class="h-5 w-5 text-red-400"/>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">
                    Please fix the following errors:
                </h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
