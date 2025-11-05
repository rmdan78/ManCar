<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GlobalFunctionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once base_path('/app/Functions/index.php');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
