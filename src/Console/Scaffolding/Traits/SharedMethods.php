<?php

namespace Rafni\LaravelToolkit\Console\Scaffolding\Traits;

/**
 * Trait SharedMethods
 * @package Rafni\LaravelToolkit\Console\Scaffolding
 */
trait SharedMethods
{    
    /**
     * Gets the relative path of the stub required
     * 
     * @param string $stub
     * @return string
     */
    protected function getStubPath($stub)
    {
        return __DIR__ . '/../../../../stubs/'.$stub.'.php';
    }
    
    /**
     * Gets the relative path of the views required
     * 
     * @return string
     */
    protected function getViewsPath()
    {
        return __DIR__ . '/../../../../views';
    }
    
    /**
     * Gets the argument name in singular
     * 
     * @param string $string
     * @return string
     */
    protected function getSingular($string)
    {
        return strtolower(str_singular($string));
    }
    
    /**
     * Gets the argument name in plural
     * 
     * @param string $string
     * @return string
     */
    protected function getPlural($string)
    {
        return strtolower(str_plural($string));
    }
    
    /**
     * Replace in the template the attributes
     * 
     * @param array $replacers
     * @return string
     */
    protected function replacer(array $replacers)
    {
        list($keys, $values) = array_divide($replacers);
        
        return str_replace($keys, $values, $this->stub);
    }
    
    /**
     * Gets the namespace for this module
     * 
     * @return string
     */
    protected function getModule()
    {
        return studly_case($this->getPlural($this->argument('name')));
    }
    
    /**
     * Gets the name used by the model
     * 
     * @return string
     */
    protected function getModel()
    {
        return studly_case($this->getSingular($this->argument('name')));
    }
    
    /**
     * Gets the name used by the service
     * 
     * @return string
     */
    protected function getService()
    {
        return studly_case($this->getPlural($this->argument('name'))).'Service';
    }
    
    /**
     * Gets the name used by the contract
     * 
     * @return string
     */
    protected function getContract()
    {
        return studly_case($this->getPlural($this->argument('name'))).'Contract';
    }
    
    /**
     * Gets the name used by the controller
     * 
     * @return string
     */
    protected function getController()
    {
        return studly_case($this->getPlural($this->argument('name'))).'Controller';
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
    
}
