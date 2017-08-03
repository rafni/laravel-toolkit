<?php

namespace Rafni\LaravelToolkit\Console\Scaffolding\Traits;

/**
 * Trait FileSystem
 * @package Rafni\LaravelToolkit\Console\Scaffolding
 */
trait FileSystem
{
    /**
     * Gets the base directory of the modules in the application
     */
    protected function getDirectoryModules()
    {
        return 'Services';
    }
    
    /**
     * Check and create necessary directories
     * 
     * @throws PrivilegeException
     */
    protected function makeDirectories($controller = false)
    {
        $this->mainDirectory();
        $this->moduleDirectory();
        if ($controller) {
            
        }
    }
    
    /**
     * Check or create the main modules directory
     * 
     * @throws PrivilegeException
     */
    protected function mainDirectory()
    {
        $directory = app_path($this->getDirectoryModules());
        if (! $this->filesystem->exists($directory)) {
            if (! $this->filesystem->makeDirectory($directory)) {
                throw new PrivilegeException('You do not have privileges to generate the necessary directories in the route: '.$directory);
            }
        }
    }
    
    /**
     * Check or create the module directory
     * 
     * @throws PrivilegeException
     */
    protected function moduleDirectory()
    {
        $directory = app_path($this->getDirectoryModules().'/'.$this->getNamespace());
        if (! $this->filesystem->exists($directory)) {
            if (! $this->filesystem->makeDirectory($directory)) {
                throw new PrivilegeException('You do not have privileges to generate the necessary directories in the route: '.$directory);
            }
        }
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
    
    /**
     * Get the file path
     * 
     * @return string
     */
    protected function getFilePath()
    {
        return app_path($this->getDirectoryModules().'/'.$this->getNamespace().'/'.$this->getFileName());
    }
    
    /**
     * Write the file into the application's file system
     */
    protected function writeFile()
    {
        if (! $this->filesystem->exists($this->getFilePath())) {
            if ($this->filesystem->put($this->getFilePath(), $this->getFileContent())) {
                $this->info('Model created successfully.');
            }
            
        } else {
            $this->error('Model already exists!');
        }
    }
    
}
