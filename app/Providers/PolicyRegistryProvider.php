<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PolicyRegistryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(\App\Models\Vehicle\Vehicle::class, \App\Policies\Vehicle\VehiclePolicy::class);
        Gate::policy(\App\Models\Vehicle\Transaction\Transaction::class, \App\Policies\Vehicle\Transaction\TransactionPolicy::class);
        Gate::policy(\App\Models\User\User::class, \App\Policies\User\UserPolicy::class);
        
    }
}
