<?php

namespace Zwaldeck\Core\DependencyInjection;

/**
 * Class ContainerAware
 * @package Zwaldeck\Core\DependencyInjection
 */
abstract class ContainerAware implements ContainerAwareInterface
{
    protected $container;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
}