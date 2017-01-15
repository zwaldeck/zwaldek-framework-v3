<?php

namespace Zwaldeck\TMP;


class Service2
{
    private $arg1;
    private $arg2;
    private $service1;

    public function __construct($arg1, string $arg2, Service1 $service1)
    {
        $this->arg1 = $arg1;
        $this->arg2 = $arg2;
        $this->service1 = $service1;
    }
}