<?php

namespace Zwaldeck\Plugins\FrameworkPlugin\Router\Parser;


use Zwaldeck\Core\File\Parser\Parser;

/**
 * Class RouteParser
 * @package Zwaldeck\Plugins\FrameworkPlugin\Router\Parser
 */
abstract class RouteParser extends Parser implements RouteParserInterface
{
    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var string
     */
    protected $namespace;

    /**
     * RouteParser constructor.
     * @param string $namespace
     * @param $content
     */
    public function __construct(string $namespace, $content)
    {
        parent::__construct($content);
        $this->namespace = $namespace;
    }


    public function getRoutes(): array
    {
        return $this->routes;
    }


}