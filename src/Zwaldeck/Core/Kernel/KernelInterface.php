<?php

namespace Zwaldeck\Core\Kernel;

use Zwaldeck\Core\Http\Request;
use Zwaldeck\Core\Http\Response;

/**
 * Interface KernelInterface
 * @package Zwaldeck\Core\Kernel
 */
interface KernelInterface
{
    public function loadPlugins(): array ;
    public function boot(): void;
    public function getRootDir(): string ;
    public function handleRequest(Request $request): ?Response;
}