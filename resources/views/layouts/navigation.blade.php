<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <x-icon name="home" class="mr-3 h-5 w-5" />
                        <span>Dashboard</span>
                    </x-nav-link>

                    @if (auth()->user()->is_admin)
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                            <x-icon name="users" class="mr-3 h-5 w-5" />
                            <span>Users</span>
                        </x-nav-link>
                        <x-nav-link :href="route('activities.index')" :active="request()->routeIs('activities.*')">
                            <x-icon name="clock" class="mr-3 h-5 w-5" />
                            <span>Activities</span>
                        </x-nav-link>
                        <x-nav-link :href="route('subscription.index')" :active="request()->routeIs('subscription.*')">
                            <x-icon name="credit-card" class="mr-3 h-5 w-5" />
                            <span>Subscriptions</span>
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('subscription.index')" :active="request()->routeIs('subscription.*')">
                            <x-icon name="credit-card" class="mr-3 h-5 w-5" />
                            <span>Subscription</span>
                        </x-nav-link>
                        <x-nav-link :href="route('download')" :active="request()->routeIs('download')">
                            <x-icon name="download" class="mr-3 h-5 w-5" />
                            <span>Download</span>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <x-icon name="chevron-down" class="h-4 w-4" />
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>