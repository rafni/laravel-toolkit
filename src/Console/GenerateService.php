<?php


namespace Agile\LaravelToolkit\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Agile\LaravelToolkit\Exceptions\PrivilegeException;

class GenerateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name : name of the service in singular}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new scaffolding for an service package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Generating scaffolds for service');
        $resource = [
            'singular_key' => strtolower($this->argument('name')),
            'resource_key' => strtolower(str_plural($this->argument('name')))
        ];
        
        $this->makeDirectories($resource);
        $this->generateModel($resource);
        $this->generateContract($resource);
        $this->generateService($resource);
        $this->generateController($resource);
        $this->generateViews($resource);
        $this->generateMigration($resource);
        $this->generateRoutes($resource);
    }

    /**
     * Generates the model for the module
     * 
     * @param $resource
     */
    protected function generateModel($resource)
    {
        $namespace = studly_case($resource['resource_key']);
        $model_file = app_path('Repositories/'.$namespace.'/'.studly_case($resource['singular_key']).'Eloquent.php');

        $model_content = $this->files->get(__DIR__ . '/../../stubs/model.php');
        $model_content = str_replace('ReplaceTable', $resource['resource_key'], $model_content);
        $model_content = str_replace('ReplaceClass', studly_case($resource['singular_key']), $model_content);
        $model_content = str_replace('ReplaceModule', $namespace, $model_content);
        
        if (!$this->files->exists($model_file)) {
            $this->files->put($model_file, $model_content);
        }
    }

    /**
     * Generates the contract for the service
     * 
     * @param $resource
     */
    protected function generateContract($resource)
    {
        $namespace = studly_case($resource['resource_key']);
        $service_name = studly_case($resource['resource_key']).'Service';
        $contract_file = app_path('Repositories/'.$namespace.'/'.$service_name.'Contract'.'.php');

        $contract_content = $this->files->get(__DIR__ . '/../../stubs/contract.php');
        $contract_content = str_replace('ReplaceContract', $service_name.'Contract', $contract_content);
        $contract_content = str_replace('ReplaceModel', studly_case($resource['singular_key']), $contract_content);
        $contract_content = str_replace('ReplaceModule', $namespace, $contract_content);
        if (!$this->files->exists($contract_file)) {
            $this->files->put($contract_file, $contract_content);
        }
    }

    /**
     * Generates the service for the module
     * 
     * @param $resource
     */
    protected function generateService($resource)
    {
        $namespace = studly_case($resource['resource_key']);
        $service_name = studly_case($resource['resource_key']).'Service';
        $service_file = app_path('Repositories/'.$namespace.'/'.$service_name.'.php');

        $service_content = $this->files->get(__DIR__ . '/../../stubs/service.php');
        $service_content = str_replace('ReplaceModel', studly_case($resource['singular_key']), $service_content);
        $service_content = str_replace('ReplaceContract', $service_name.'Contract', $service_content);
        $service_content = str_replace('ReplaceModule', $namespace, $service_content);
        if (!$this->files->exists($service_file)) {
            $this->files->put($service_file, $service_content);
        }
    }

    /**
     * Generates the controller for the module
     * 
     * @param $resource
     */
    protected function generateController($resource)
    {
        $namespace = studly_case($resource['resource_key']);
        $service_name = studly_case($resource['resource_key']).'Service';
        $controller_name = studly_case($resource['resource_key']).'Controller';
        $controller_file = app_path('Http/Controllers/'.$namespace.'/'.$controller_name.'.php');
        
        $controller_content = $this->files->get(__DIR__ . '/../../stubs/controller.php');
        $controller_content = str_replace('ReplaceContract', $service_name.'Contract', $controller_content);
        $controller_content = str_replace('ReplaceModule', $namespace, $controller_content);
        $controller_content = str_replace('ReplacePlural', $resource['resource_key'], $controller_content);
        $controller_content = str_replace('ReplaceSingular', $resource['singular_key'], $controller_content);
        if (!$this->files->exists($controller_file)) {
            $this->files->put($controller_file, $controller_content);
        }
    }
    
    /**
     * Generates the views for the module
     * 
     * @param $resource
     */
    protected function generateViews($resource)
    {
        $namespace = $resource['resource_key'];
        $views = $this->files->files(__DIR__ . '/../../views');
        
        foreach ($views as $view_file) {
            $file_name = $this->files->basename($view_file);
            $view_file_destiny = resource_path('views/'.$namespace.'/'.$file_name);
            
            if(!is_dir(resource_path('views/'.$namespace))){
                mkdir(resource_path('views/'.$namespace));
            }
            $view_content = $this->files->get($view_file);
            $view_content = str_replace('ReplacePlural', $resource['resource_key'], $view_content);
            $view_content = str_replace('ReplaceSingular', $resource['singular_key'], $view_content);
            if (!$this->files->exists($view_file_destiny)) {
                $this->files->put($view_file_destiny, $view_content);
            }
        }
    }
    
    /**
     * Generates the migration for the module
     * 
     * @param $resource
     */
    protected function generateMigration($resource)
    {
        try {
            $this->call('make:migration', [
                'name' => 'create_'.$resource['resource_key'].'_table',
                '--create' => $resource['resource_key']
            ]);
        } catch (\Exception $e) {
            $this->comment($e->getMessage());
        }
    }
    
    /**
     * Generates the routes for the module
     * 
     * @param $resource
     */
    protected function generateRoutes($resource)
    {
        $plural = $resource['resource_key'];
        $singular = $resource['singular_key'];
        $namespace = studly_case($resource['resource_key']);
        
        $this->line('');
        $this->comment('Generating the routes for the module, please, copy and paste the next routes in your routes file');
        
        // Index
        $this->line("Route::get('{$plural}', '{$namespace}\\{$namespace}Controller@index')->name('{$singular}.index');");
        // Create
        $this->line("Route::get('{$singular}/create', '{$namespace}\\{$namespace}Controller@create')->name('{$singular}.create');");
        // Store
        $this->line("Route::post('{$singular}', '{$namespace}\\{$namespace}Controller@store')->name('{$singular}.store');");
        // Show
        $this->line("Route::get('{$singular}/{id}', '{$namespace}\\{$namespace}Controller@show')->name('{$singular}.show')->where('id', '[0-9]+');");
        // Edit
        $this->line("Route::get('{$singular}/{id}/edit', '{$namespace}\\{$namespace}Controller@edit')->name('{$singular}.edit')->where('id', '[0-9]+');");
        // Update
        $this->line("Route::put('{$singular}/{id}', '{$namespace}\\{$namespace}Controller@update')->name('{$singular}.update')->where('id', '[0-9]+');");
        // Update
        $this->line("Route::delete('{$singular}/{id}/delete', '{$namespace}\\{$namespace}Controller@destroy')->name('{$singular}.delete')->where('id', '[0-9]+');");
        
        $this->line('');
    }

    /**
     * Checks if the directory structure exists
     */
    protected function makeDirectories($resource)
    {
        $namespace = studly_case($resource['resource_key']);
        
        if(!is_dir(app_path('Repositories'))) {
            if (!mkdir(app_path('Repositories'))) {
                throw new PrivilegeException('You do not have privileges to generate the necessary directories in the route: '.app_path());
            }
        }
        if(!is_dir(app_path('Repositories/'.$namespace))) {
            if (!mkdir(app_path('Repositories/'.$namespace))) {
                throw new PrivilegeException('You do not have privileges to generate the necessary directories in the route: '.app_path('Repositories'));
            }
        }
        if(!is_dir(app_path('Http/Controllers/'.$namespace))){
            if (!mkdir(app_path('Http/Controllers/'.$namespace))) {
                throw new PrivilegeException('You do not have privileges to generate the necessary directories in the route: '.app_path('Http/Controllers'));
            }
        }
    }
}
