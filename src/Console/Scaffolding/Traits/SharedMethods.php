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
    
}
