<?php
namespace Rafni\LaravelToolkit\Traits;

use Jenssegers\Date\Date;

/**
 * This is a trait overwrites methods to
 * replace Carbon with Date.
 *
 * @package Jenssegers\Date
 */
trait EloquentCarbonReplacer
{
    /**
     * Get a fresh timestamp for the model.
     *
     * @return Jenssegers\Date\Date
     */
    public function freshTimestamp()
    {
        return new Date();
    }
    
    /**
     * Return a timestamp as DateTime object.
     *
     * @param  mixed  $value
     * @return Jenssegers\Date\Date
     */
    protected function asDateTime($value)
    {
        if (is_numeric($value)) {
            return Date::createFromTimestamp($value);
            
        } elseif (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $value)) {
            return Date::createFromFormat('Y-m-d', $value)->startOfDay();
            
        } elseif (! $value instanceof DateTime) {
            $format = $this->getDateFormat();
            return Date::createFromFormat($format, $value);
        }
        
        return Date::instance($value);
    }
}