<?php
namespace Zwaldeck\Core\Plugin;

use Zwaldeck\Core\File\Parser\ServiceParser;
use Zwaldeck\Plugins\FrameworkPlugin\Router\Parser\RouteParser;

/**
 * Interface PluginInterface
 * @package Zwaldeck\Core\Plugin
 */
interface PluginInterface
{
    public function boot(): void;
    public function getName(): string;
    public function getNamespace(): string;
    public function getPath(): string;
    public function getServiceParser(): ?ServiceParser;
    public function getRouteParser(): ?RouteParser;
}