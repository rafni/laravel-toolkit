<?php

namespace Rafni\LaravelToolkit\Console\Scaffolding;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Rafni\LaravelToolkit\Console\Scaffolding\Traits\SharedMethods;
use Rafni\LaravelToolkit\Console\Scaffolding\Traits\FileSystem as FileSystemTrait;

class ViewBuilder extends Command
{
    use SharedMethods, FileSystemTrait;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toolkit:views {name : Name of the service package in singular}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate views for the service';
    
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
     * 
     * @var string
     */
    protected $view_filename = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->filesystem = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->views() as $view_file) {
            $this->view_filename = $this->filesystem->basename($view_file);
            $this->stub = $this->filesystem->get($this->getViewsPath().'/'.$this->view_filename);
            
            $this->writeFile('View '.$this->view_filename);
        }
    }
    
    protected function views()
    {
        return $this->filesystem->files($this->getViewsPath());
    }
    
    /**
     * Gets the contents of the view file
     * 
     * @return string
     */
    public function getFileContent()
    {
        $replacers = [
            'ReplacePlural' => $this->getPlural($this->argument('name')),
            'ReplaceSingular' => $this->getSingular($this->argument('name'))
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
        return $this->view_filename;
    }
    
    /**
     * Get the file path
     * 
     * @return string
     */
    protected function getFilePath()
    {
        return $this->viewsDirectory().'/'.$this->getFileName();
    }
    
}
