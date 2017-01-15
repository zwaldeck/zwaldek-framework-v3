<?php

namespace Zwaldeck\Core\DependencyInjection;


use Zwaldeck\Core\DependencyInjection\Service\Service;
use Zwaldeck\Core\Util\Freezable;

interface ContainerInterface extends Freezable
{
    //services
    public function addService(string $name, Service $service): void;
    public function getService(string $name);
    public function getServices() : array;
    public function hasService(string $name): bool;

    //parameters
    public function addParameter(string $name, string $value): void;
    public function getParameter(string $name): string;
    public function getParameters() : array;
    public function hasParameter(string $name): bool;
}