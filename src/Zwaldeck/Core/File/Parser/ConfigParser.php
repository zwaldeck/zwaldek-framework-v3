<?php

namespace Zwaldeck\Core\File\Parser;


use Zwaldeck\Core\File\FileLoader;
use Zwaldeck\Core\File\XmlFileLoader;

abstract class ConfigParser extends Parser implements ConfigParserInterface
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }
}