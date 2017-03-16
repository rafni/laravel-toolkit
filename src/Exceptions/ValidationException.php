<?php

namespace Agile\LaravelToolkit\Exceptions;

use RuntimeException;

/**
 * Class ValidationException
 * @package Agile\LaravelToolkit\Exceptions
 */
class ValidationException extends RuntimeException
{
    /**
     * @var \Illuminate\Support\Collection|array
     */
    protected $messages;

    /**
     * ValidationException constructor.
     * @param string $messages
     */
    public function __construct($messages)
    {
        $this->messages = is_array($messages) ? collect($messages) : $messages;
    }

    /**
     * @return array|\Illuminate\Support\Collection|string
     */
    public function gerMessageBag()
    {
        return $this->messages;
    }

}