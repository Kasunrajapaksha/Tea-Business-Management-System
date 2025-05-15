<?php

namespace App\Providers;

use App\Models\Permission;
use App\Policies\PermissionPolicy;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        // Gate::policy(Permission::class, PermissionPolicy::class);
        \Illuminate\Pagination\Paginator::useBootstrapFive();
    }
}
