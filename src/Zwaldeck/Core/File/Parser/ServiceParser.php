<?php

namespace Zwaldeck\Core\File\Parser;
use Zwaldeck\Core\DependencyInjection\Service\Service;

/**
 * Class ServiceParser
 * @package Zwaldeck\Core\File\Parser
 */
abstract class ServiceParser extends Parser implements ServiceParserInterface
{
    /**
     * @var Service[]
     */
    protected $services = [];

    /**
     * @var array
     */
    protected $parameters = [];

    public function getServices()
    {
        return $this->services;
    }

    public function getParameters()
    {
        return $this->parameters;
    }
}