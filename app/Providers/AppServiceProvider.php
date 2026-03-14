<?php

namespace App\Providers;

use App\Helpers\MenuHelper;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('manageAdminUsers', function ($user) {
            return $user->role_type === 'superadmin';
        });

        View::composer('*', function ($view) {
            $view->with('routePrefix', MenuHelper::getCurrentPrefix());
        });
    }
}
