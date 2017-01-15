<?php

namespace Zwaldeck\Core\Exceptions;


class InvalidXMLFormatException extends \Exception
{

    public function __construct($message)
    {
        parent::__construct($message, 703);
    }
}