<?php

namespace Zwaldeck\Core\DependencyInjection;

use Zwaldeck\Core\DependencyInjection\Service\Service;
use Zwaldeck\Core\Exceptions\ParameterNotFoundException;
use Zwaldeck\Core\Exceptions\ServiceNotFoundException;

/**
 * Class Container
 * @package Zwaldeck\Core\DependencyInjection
 */
class Container implements ContainerInterface
{

    /**
     * @var array
     */
    private $services;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var bool
     */
    private $frozen;

    /**
     * Container constructor.
     */
    public function __construct()
    {
        $this->services = [];
        $this->parameters = [];
        $this->frozen = false;
    }


    /**
     * @param string $name
     * @param $service
     */
    public function addService(string $name, $service): void
    {
        if (!$this->frozen) {
            $this->services[$name] = $service;
        }
    }

    /**
     * @param string $name
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function getService(string $name)
    {
        if(!$this->hasService($name)) {
            throw new ServiceNotFoundException($name);
        }

        return $this->services[$name];
    }

    /**
     * @return array
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasService(string $name): bool
    {
        return array_key_exists($name, $this->services);
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addParameter(string $name, string $value): void
    {
        $this->parameters[$name] = $value;
    }

    /**
     * @param string $name
     * @return string
     * @throws ParameterNotFoundException
     */
    public function getParameter(string $name): string
    {
        if(!$this->hasParameter($name)) {
            throw new ParameterNotFoundException($name);
        }

        return $this->parameters[$name];
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasParameter(string $name): bool
    {
        return array_key_exists($name, $this->parameters);
    }

    /**
     * Freeze te container
     */
    public function freeze()
    {
        $this->frozen = true;
    }
}