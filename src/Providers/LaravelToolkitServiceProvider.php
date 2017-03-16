<?php

namespace Agile\LaravelToolkit\Providers;

use Illuminate\Support\ServiceProvider;
use Agile\LaravelToolkit\Console\GenerateService;

/**
 * Class LaravelToolkitServiceProvider
 * @package Agile\LaravelToolkit\Providers
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
