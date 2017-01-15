<?php

namespace Zwaldeck\Core\Exceptions;


class ServiceLoaderException extends \Exception
{

    public function __construct($message)
    {
        parent::__construct($message, 704);
    }
}