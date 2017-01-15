<?php

namespace Zwaldeck\Core\DependencyInjection\Service;

/**
 * Class Service
 * @package Zwaldeck\Core\DependencyInjection\Service
 */
class Service
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $class;

    /**
     * @var array
     */
    private $constructorArgs;

    /**
     * @var array
     */
    private $dependsOn;

    /**
     * Service constructor.
     */
    public function __construct()
    {
        $this->constructorArgs = [];
        $this->dependsOn = [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class)
    {
        $this->class = $class;
    }

    /**
     * @return array
     */
    public function getConstructorArgs(): array
    {
        return $this->constructorArgs;
    }

    public function addConstructorArgument(ConstructorArgument $argument) {
        $this->constructorArgs[] = $argument;
    }
}