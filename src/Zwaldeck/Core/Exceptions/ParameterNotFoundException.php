<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class ParameterNotFoundException
 * @package Zwaldeck\Core\Exceptions
 */
class ParameterNotFoundException extends \Exception
{
    public function __construct($name)
    {
        parent::__construct("Parameter '{$name}' not found!", 702);
    }
}