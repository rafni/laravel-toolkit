<?php

namespace Rafni\LaravelToolkit\Providers;

use Illuminate\Support\ServiceProvider;
use Rafni\LaravelToolkit\Console\GenerateService;

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
        $this->commands(\Rafni\LaravelToolkit\Console\Scaffolding\ModelBuilder::class);
        $this->commands(GenerateService::class);
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
