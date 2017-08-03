<?php

namespace Rafni\LaravelToolkit\Console\Scaffolding;

use Illuminate\Console\Command;
use Rafni\LaravelToolkit\Console\Scaffolding\Traits\SharedMethods;

class RoutesBuilder extends Command
{
    use SharedMethods;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toolkit:routes {name : Name of the service package in singular}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show example routes for a service';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $routes = [
            ["Route::get('{$this->getPlural($name)}', '{$this->getModule()}\\{$this->getController()}@index')->name('{$this->getSingular($name)}.index');"],
            ["Route::get('{$this->getSingular($name)}/create', '{$this->getModule()}\\{$this->getController()}@create')->name('{$this->getSingular($name)}.create');"],
            ["Route::post('{$this->getSingular($name)}', '{$this->getModule()}\\{$this->getController()}@store')->name('{$this->getSingular($name)}.store');"],
            ["Route::get('{$this->getSingular($name)}/{id}', '{$this->getModule()}\\{$this->getController()}@show')->name('{$this->getSingular($name)}.show')->where('id', '[0-9]+');"],
            ["Route::get('{$this->getSingular($name)}/{id}/edit', '{$this->getModule()}\\{$this->getController()}@edit')->name('{$this->getSingular($name)}.edit')->where('id', '[0-9]+');"],
            ["Route::put('{$this->getSingular($name)}/{id}', '{$this->getModule()}\\{$this->getController()}@update')->name('{$this->getSingular($name)}.update')->where('id', '[0-9]+');"],
            ["Route::delete('{$this->getSingular($name)}/{id}/delete', '{$this->getModule()}\\{$this->getController()}@destroy')->name('{$this->getSingular($name)}.delete')->where('id', '[0-9]+');"],
        ];
        $this->table(['Routes'], $routes);
    }
    
}
