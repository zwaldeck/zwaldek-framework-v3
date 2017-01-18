<?php

namespace Zwaldeck\Plugins\FrameworkPlugin\Router;

/**
 * Class Route
 * @package Zwaldeck\Plugins\FrameworkPlugin\Router
 */
class Route
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * Route constructor.
     * @param $uri
     * @param $controller
     * @param $action
     */
    public function __construct(string $uri, string $controller, string $action)
    {
        $this->uri = $uri;
        $this->controller = $controller;
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }
}