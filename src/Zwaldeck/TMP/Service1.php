<?php

namespace Zwaldeck\TMP;


class Service1
{
    private $arg1;
    private $arg2;

    public function __construct($arg1, array $arg2)
    {
        $this->arg1 = $arg1;
        $this->arg2 = $arg2;
    }
}