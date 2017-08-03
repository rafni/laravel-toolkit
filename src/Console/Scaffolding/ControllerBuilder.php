<?php

namespace Rafni\LaravelToolkit\Console\Scaffolding;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Rafni\LaravelToolkit\Console\Scaffolding\Traits\SharedMethods;
use Rafni\LaravelToolkit\Console\Scaffolding\Traits\FileSystem as FileSystemTrait;

class ControllerBuilder extends Command
{
    use SharedMethods, FileSystemTrait;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toolkit:controller {name : Name of the service in singular}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller for a service';
    
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
        $this->stub = $files->get($this->getStubPath('controller'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->makeDirectories();
        $this->writeFile('Controller');
    }
    
    /**
     * Gets the contents of the controller file
     * 
     * @return string
     */
    public function getFileContent()
    {
        $replacers = [
            'ModulesDirectory' => $this->getDirectoryModules(),
            'ReplaceModule' => $this->getNamespace(),
            'ReplaceController' => $this->getClassName(),
            'ReplaceContract' => $this->getContract(),
            'ReplacePlural' => $this->getPlural($this->argument('name')),
            'ReplaceSingular' => $this->getSingular($this->argument('name'))
        ];
        
        return $this->replacer($replacers);
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
     * Gets the class name that the controller uses
     * 
     * @return string
     */
    protected function getClassName()
    {
        return studly_case($this->getPlural($this->argument('name'))).'Controller';
    }
    
    /**
     * Gets the contract that will be used in the service
     * 
     * @return string
     */
    protected function getContract()
    {
        return studly_case($this->getSingular($this->argument('name'))).'Contract';
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
