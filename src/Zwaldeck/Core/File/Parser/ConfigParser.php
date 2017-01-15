<?php

namespace Zwaldeck\Core\File\Parser;


use Zwaldeck\Core\File\FileLoader;
use Zwaldeck\Core\File\XmlFileLoader;

abstract class ConfigParser implements ConfigParserInterface
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var mixed
     */
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Dispose conent to free up memory
     * Only do this after parsing!
     */
    protected function disposeContent(): void
    {
        $this->content = null;
    }
}