<?php

namespace Zwaldeck\Core\Exceptions;

use Exception;

/**
 * Class FileNotFoundException
 * @package Zwaldeck\Core\Exceptions
 */
class FileNotFoundException extends \Exception
{
    public function __construct($file)
    {
        parent::__construct("File '{$file}' not found!", 700);
    }
}