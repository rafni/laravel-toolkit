<?php

namespace Rafni\LaravelToolkit\Console\Scaffolding;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Rafni\LaravelToolkit\Console\Scaffolding\Traits\SharedMethods;
use Rafni\LaravelToolkit\Console\Scaffolding\Traits\FileSystem as FileSystemTrait;

class ContractBuilder extends Command
{
    use SharedMethods, FileSystemTrait;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toolkit:contract {name : Name of the service in singular}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a contract for the service';
    
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
        $this->stub = $files->get($this->getStubPath('contract'));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->makeDirectories();
        $this->writeFile('Contract');
    }
    
    /**
     * Gets the contents of the contract file
     * 
     * @return string
     */
    public function getFileContent()
    {
        $replacers = [
            'ModulesDirectory' => $this->getDirectoryModules(),
            'ReplaceModule' => $this->getModule(),
            'ReplaceContract' => $this->getContract(),
            'ReplaceModel' => $this->getModel()
        ];
        
        return $this->replacer($replacers);
    }
    
    /**
     * Get the filename of the file
     * 
     * @return string
     */
    protected function getFileName()
    {
        return $this->getContract().'.php';
    }
    
}
