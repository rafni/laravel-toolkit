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
        if ($controller) {
            $this->controllerDirectory();
        } else {
            $this->moduleDirectory();
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
        return $directory;
    }
    
    /**
     * Check or create the module directory
     * 
     * @throws PrivilegeException
     */
    protected function moduleDirectory()
    {
        $directory = app_path($this->getDirectoryModules().'/'.$this->getModule());
        if (! $this->filesystem->exists($directory)) {
            if (! $this->filesystem->makeDirectory($directory)) {
                throw new PrivilegeException('You do not have privileges to generate the necessary directories in the route: '.$directory);
            }
        }
        return $directory;
    }
    
    /**
     * Check or create the controller directory
     * 
     * @throws PrivilegeException
     */
    protected function controllerDirectory()
    {
        $directory = app_path('Http/Controllers/'.$this->getModule());
        if (! $this->filesystem->exists($directory)) {
            if (! $this->filesystem->makeDirectory($directory)) {
                throw new PrivilegeException('You do not have privileges to generate the necessary directories in the route: '.$directory);
            }
        }
        return $directory;
    }
    
    /**
     * Get the file path
     * 
     * @return string
     */
    protected function getFilePath()
    {
        return $this->moduleDirectory().'/'.$this->getFileName();
    }
    
    /**
     * Write the file into the application's file system
     * 
     * @param string $type
     */
    protected function writeFile($type)
    {
        if (! $this->filesystem->exists($this->getFilePath())) {
            if ($this->filesystem->put($this->getFilePath(), $this->getFileContent())) {
                $this->info($type.' created successfully.');
            }
            
        } else {
            $this->error($type.' already exists!');
        }
    }
    
}
