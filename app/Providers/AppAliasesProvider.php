<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppAliasesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $loader = AliasLoader::getInstance();

        $loader = $loader->alias('StorageHelper', \App\Helpers\StorageHelper::class);        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
