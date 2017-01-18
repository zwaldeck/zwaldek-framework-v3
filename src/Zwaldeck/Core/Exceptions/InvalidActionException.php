<?php

namespace Zwaldeck\Core\Exceptions;

use Exception;

/**
 * Class FileNotFoundException
 * @package Zwaldeck\Core\Exceptions
 */
class InvalidActionException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message, 709);
    }
}