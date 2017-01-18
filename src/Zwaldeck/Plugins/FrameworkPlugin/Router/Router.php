<?php

namespace Zwaldeck\Plugins\FrameworkPlugin\Router;

use Zwaldeck\Core\DependencyInjection\ContainerAware;
use Zwaldeck\Core\Exceptions\ActionNotFoundException;
use Zwaldeck\Core\Exceptions\ControllerNotFoundException;
use Zwaldeck\Core\Exceptions\InvalidActionException;
use Zwaldeck\Core\Exceptions\InvalidControllerClassException;
use Zwaldeck\Core\Http\Request;
use Zwaldeck\Core\Http\Response;
use Zwaldeck\Core\Plugin\Plugin;
use Zwaldeck\Core\Plugin\PluginManager;
use Zwaldeck\Core\Util\StringUtils;

/**
 * Class Router
 * @package Zwaldeck\Plugins\FrameworkPlugin\Router
 */
class Router extends ContainerAware
{
    /**
     * @var array
     */
    private $routes = [];

    public function __construct()
    {
        $pluginManager = PluginManager::getInstance();

        //load in routes
        /** @var Plugin $plugin */
        foreach ($pluginManager->getPlugins() as $plugin) {
            $routeParser = $plugin->getRouteParser();
            if ($routeParser !== null) {
                $this->routes = array_merge($this->routes, $plugin->getRouteParser()->getRoutes());
            }
        }
    }

    public function dispatch(Request $request): ?Response
    {
        $uriParts = $this->getUriParts($request->getRequestURI());

        /** @var Route $route */
        foreach ($this->routes as $route) {
            $routeParts = $this->getUriParts($route->getUri());
            if (count($routeParts) === count($uriParts)) {
                if (StringUtils::contains($route->getUri(), '{') && StringUtils::contains($route->getUri(), '}')) {
                    $params = [];
                    $validRoute = true;

                    for ($i = 0; $i < count($routeParts); $i++) {
                        $routePart = $routeParts[$i];
                        if (StringUtils::startsWith($routePart, '{') && StringUtils::endsWith($routePart, '}')) {
                            $params[rtrim(ltrim($routePart, '{'), '}')] = $uriParts[$i];
                        } else if ($routePart !== $uriParts[$i]) {
                            $validRoute = false;
                            break;
                        }
                    }

                    if ($validRoute) {
                        return $this->doRouting($request, $route, $params);
                    }

                } else {
                    if ($route->getUri() === $request->getRequestURI()) {
                        return $this->doRouting($request, $route);
                    }
                }
            }
        }

        //TODO render 404
        return null;
    }

    /**
     * @param Request $request
     * @param Route $route
     * @param array $params
     * @return Response
     * @throws ActionNotFoundException
     * @throws ControllerNotFoundException
     * @throws InvalidActionException
     * @throws InvalidControllerClassException
     */
    private function doRouting(Request $request, Route $route, array $params = []): ?Response
    {
        try {
            $refObj = new \ReflectionClass($route->getController());
        } catch (\Exception $e) {
            throw new ControllerNotFoundException($route->getController());
        }

        if (!$refObj->isSubclassOf('Zwaldeck\\Core\\Controller\\Controller')) {
            throw new InvalidControllerClassException($route->getController());
        }

        if (!$refObj->hasMethod($route->getAction())) {
            throw new ActionNotFoundException($route->getAction(), $route->getController());
        }

        $refAction = $refObj->getMethod($route->getAction());
        if (!$refAction->hasReturnType() || $refAction->getReturnType()->__toString() !== 'Zwaldeck\\Core\\Http\\Response') {
            throw new InvalidActionException(
                "The action '{$route->getAction()}' of controller '{$route->getController()}' needs to have a "
                . "return type defined of 'Zwaldeck\\Core\\Http\\Response'"
            );
        }

        if ((!empty($params) && empty($refAction->getParameters())) ||
            (count($params) !== count($refAction->getParameters()))
        ) {
            throw new InvalidActionException(
                "The action '{$route->getAction()}' of controller '{$route->getController()}' does not have the same amount "
                . "of parameters that you defined in your routes.xml"
            );
        }

        $paramValues = [];
        foreach ($refAction->getParameters() as $parameter) {
            $argGiven = array_key_exists($parameter->getName(), $params);
            if (!$argGiven && !$parameter->isDefaultValueAvailable()) {
                throw new InvalidActionException(
                    "The action '{$route->getAction()}' of controller '{$route->getController()}' has a parameter called '{$parameter->getName()}'".
                    " but this is not defined inside your routes.xml!"
                );
            }

            $paramValues[$parameter->getPosition()] = $argGiven ? $params[$parameter->getName()] : $parameter->getDefaultValue();
        }

        $controller = $refObj->newInstanceArgs([$request]);
        $controller->setContainer($this->container);

        return call_user_func_array(
            [$controller, $route->getAction()],
            $paramValues
        );
    }

    /**
     * @param string $uri
     * @return array
     */
    private function getUriParts(string $uri): array
    {
        if (!StringUtils::startsWith($uri, '/')) {
            $uri = '/' . $uri;
        }

        $uriParts = explode('/', $uri);
        array_shift($uriParts);

        return $uriParts;
    }
}