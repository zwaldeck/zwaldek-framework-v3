<?php

namespace Zwaldeck\Core\Plugin;

use Zwaldeck\Core\File\Parser\ServiceParser;
use Zwaldeck\Core\File\Parser\XML\XMLServiceParser;
use Zwaldeck\Core\File\XmlFileLoader;

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

    public function getServiceParser(): ServiceParser
    {
        $fileLoader = new XmlFileLoader();
        $fileLoader->loadFile($this->getPath().'/Res/Config/services.xml');
        $serviceParser = new XMLServiceParser($fileLoader->getContent());
        $serviceParser->parse();


        $fileLoader = null;
        return $serviceParser;
    }

    public function getRouterParser()
    {
    }

}