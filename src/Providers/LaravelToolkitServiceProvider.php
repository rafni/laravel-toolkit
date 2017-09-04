<?php

namespace Rafni\LaravelToolkit\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelToolkitServiceProvider
 * @package Rafni\LaravelToolkit\Providers
 */
class LaravelToolkitServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            \Rafni\LaravelToolkit\Console\Scaffolding\PackageBuilder::class,
            \Rafni\LaravelToolkit\Console\Scaffolding\ControllerBuilder::class,
            \Rafni\LaravelToolkit\Console\Scaffolding\ModelBuilder::class,
            \Rafni\LaravelToolkit\Console\Scaffolding\ServiceBuilder::class,
            \Rafni\LaravelToolkit\Console\Scaffolding\ContractBuilder::class,
            \Rafni\LaravelToolkit\Console\Scaffolding\RoutesBuilder::class,
            \Rafni\LaravelToolkit\Console\Scaffolding\MigrationBuilder::class,
            \Rafni\LaravelToolkit\Console\Scaffolding\ViewBuilder::class,
        ]);
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
