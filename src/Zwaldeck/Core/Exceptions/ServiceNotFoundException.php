<?php

namespace Zwaldeck\Core\Exceptions;

/**
 * Class ServiceNotFoundException
 * @package Zwaldeck\Core\Exceptions
 */
class ServiceNotFoundException extends \Exception
{
    public function __construct($name)
    {
        parent::__construct("Service '{$name}' not found!", 701);
    }
}