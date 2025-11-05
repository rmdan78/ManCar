<?php

namespace App\Providers;

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
        $this->loadMigrationsFrom([
            database_path('migrations/alter/add'),
            database_path('migrations/alter/change'),
            database_path('migrations/alter/drop'),
            database_path('migrations/alter/rename'),
            database_path('migrations/create'),
            database_path('migrations/create/oauth'),
            database_path('migrations/drop'),
        ]);
    }
}
