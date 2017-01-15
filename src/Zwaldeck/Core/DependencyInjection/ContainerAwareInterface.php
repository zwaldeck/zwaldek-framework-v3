<?php

namespace Zwaldeck\Core\DependencyInjection;

/**
 * Interface ContainerAwareInterface
 * @package Zwaldeck\Core\DependencyInjection
 */
interface ContainerAwareInterface
{
    public function setContainer(ContainerInterface $container);
}