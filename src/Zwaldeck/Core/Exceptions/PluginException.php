<?php

namespace Zwaldeck\Core\Exceptions;


class PluginException extends \Exception
{

    public function __construct($message)
    {
        parent::__construct($message, 705);
    }
}