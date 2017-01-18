<?php

namespace Zwaldeck\Core\Plugin;

use Zwaldeck\Core\File\Parser\ServiceParser;
use Zwaldeck\Core\File\Parser\XML\XMLServiceParser;
use Zwaldeck\Core\File\XmlFileLoader;
use Zwaldeck\Plugins\FrameworkPlugin\Router\Parser\RouteParser;
use Zwaldeck\Plugins\FrameworkPlugin\Router\Parser\XML\XMLRouteParser;

/**
 * Class Plugin
 * @package Zwaldeck\Core\Plugin
 */
abstract class Plugin implements PluginInterface
{
    public function boot(): void
    {
    }

    public function getNamespace() : string
    {
        $name = get_class($this);
        return substr($name, 0, strrpos($name, '\\'));
    }

    public function getPath(): string
    {
        $refObj = new \ReflectionObject($this);
        return dirname($refObj->getFileName());
    }

    public function getServiceParser(): ?ServiceParser
    {
        if(file_exists($this->getPath().'/Res/Config/services.xml')) {
            $fileLoader = new XmlFileLoader();
            $fileLoader->loadFile($this->getPath() . '/Res/Config/services.xml');
            $serviceParser = new XMLServiceParser($fileLoader->getContent());
            $serviceParser->parse();


            $fileLoader = null;
            return $serviceParser;
        }

        return null;
    }

    public function getRouteParser(): ?RouteParser
    {
        if(file_exists($this->getPath().'/Res/Config/routes.xml')) {
            $fileLoader = new XmlFileLoader();
            $fileLoader->loadFile($this->getPath().'/Res/Config/routes.xml');
            $routeParser = new XMLRouteParser($this->getNamespace(), $fileLoader->getContent());
            $routeParser->parse();

            $fileLoader = null;

            return $routeParser;
        }

        return null;
    }

}