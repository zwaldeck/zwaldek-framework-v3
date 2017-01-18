<?php

namespace Zwaldeck\Core\Exceptions;

use Exception;

/**
 * Class FileNotFoundException
 * @package Zwaldeck\Core\Exceptions
 */
class ActionNotFoundException extends \Exception
{
    public function __construct($action, $controller)
    {
        parent::__construct("Action '{$action}' not found in controller '{$controller}'!", 708);
    }
}