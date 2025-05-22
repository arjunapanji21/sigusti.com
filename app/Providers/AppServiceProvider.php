<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define admin actions gate
        Gate::define('admin-actions', function (User $user) {
            return $user->is_admin;
        });

        // Define user actions gate
        Gate::define('user-actions', function (User $user) {
            return !$user->is_admin;
        });
    }
}
