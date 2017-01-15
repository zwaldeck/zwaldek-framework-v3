<?php

namespace Zwaldeck\Core\DependencyInjection\Service;

/**
 * Class ConstructArgumentType
 * @package Zwaldeck\Core\DependencyInjection\Service
 */
abstract class ConstructorArgumentType
{
    const PLAIN = 1;
    const PARAMETER = 2;
    const SERVICE = 3;
}