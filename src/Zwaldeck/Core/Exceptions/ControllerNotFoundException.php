<?php

namespace Zwaldeck\Core\Exceptions;

use Exception;

/**
 * Class FileNotFoundException
 * @package Zwaldeck\Core\Exceptions
 */
class ControllerNotFoundException extends \Exception
{
    public function __construct($controller)
    {
        parent::__construct("Controller '{$controller}' not found!", 706);
    }
}