<?php

namespace Rafni\LaravelToolkit\Console\Scaffolding;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Rafni\LaravelToolkit\Console\Scaffolding\Traits\SharedMethods;
use Rafni\LaravelToolkit\Console\Scaffolding\Traits\FileSystem as FileSystemTrait;

class ModelBuilder extends Command
{
    use SharedMethods, FileSystemTrait;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toolkit:model {name : Name of the model in singular}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new custom model for eloquent';
    
    /**
     * File Handling
     * 
     * @var Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;
    
    /**
     * Template used to generate the template
     * 
     * @var string
     */
    protected $stub;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->filesystem = $files;
        $this->stub = $files->get($this->getStubPath('model'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->makeDirectories();
        $this->writeFile('Model');
    }
    
    /**
     * Gets the contents of the model file
     * 
     * @return string
     */
    public function getFileContent()
    {
        $replacers = [
            'ModulesDirectory' => $this->getDirectoryModules(),
            'ReplaceTable' => $this->getTableName(),
            'ReplaceClass' => $this->getClassName(),
            'ReplaceModule' => $this->getNamespace()
        ];
        
        return $this->replacer($replacers);
    }
    
    /**
     * Gets the name of the table that the model uses
     * 
     * @return string
     */
    protected function getTableName()
    {
        return $this->getPlural($this->argument('name'));
    }
    
    /**
     * Gets the namespace for this module
     * 
     * @return string
     */
    protected function getNamespace()
    {
        return studly_case($this->getPlural($this->argument('name')));
    }
    
    /**
     * Gets the class name that the model uses
     * 
     * @return string
     */
    protected function getClassName()
    {
        return studly_case($this->getSingular($this->argument('name')));
    }
    
    /**
     * Get the filename of the file
     * 
     * @return string
     */
    protected function getFileName()
    {
        return $this->getClassName().'.php';
    }
    
}
