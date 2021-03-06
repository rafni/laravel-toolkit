<?php

namespace Rafni\LaravelToolkit\Traits;

use Illuminate\Contracts\Validation\Factory as Validator;
use Rafni\LaravelToolkit\Exceptions\ValidationException;
/**
 * Class ValidateAbleTrait
 * @package Rafni\LaravelToolkit\Traits
 */
trait ValidateAbleTrait
{
    /**
     * Runs the validator and throws exception if fails
     * 
     * @param array $attributes
     * @param array $rules
     * @param array $messages
     * @throws ValidationException
     */
    public function runValidator(array $attributes, array $rules, array $messages)
    {
        $validator = app(Validator::class)->make($attributes, $rules, $messages);
        if ($validator->fails()) {
            throw new ValidationException($validator->getMessageBag());
        }
    }
}