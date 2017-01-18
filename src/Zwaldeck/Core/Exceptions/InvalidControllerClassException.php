<?php

namespace Zwaldeck\Core\Exceptions;

use Exception;

/**
 * Class FileNotFoundException
 * @package Zwaldeck\Core\Exceptions
 */
class InvalidControllerClassException extends \Exception
{
    public function __construct($controller)
    {
        parent::__construct("Controller '{$controller}' must extend 'Zwaldeck\\Core\\Controller\\Controller'!", 707);
    }
}