<?php

namespace Zwaldeck\Plugins\FrameworkPlugin\Router\Parser\XML;


use Zwaldeck\Core\Exceptions\InvalidXMLFormatException;
use Zwaldeck\Plugins\FrameworkPlugin\Router\Parser\RouteParser;
use Zwaldeck\Plugins\FrameworkPlugin\Router\Route;

/**
 * Class XMLRouteParser
 * @package Zwaldeck\Plugins\FrameworkPlugin\Router\Parser\XML
 */
class XMLRouteParser extends RouteParser
{

    public function parse()
    {
        if(!empty($this->content) && !empty($this->content->children())) {
            foreach ($this->content->children() as $routeElement) {
                $this->checkRouteXMLSyntax($routeElement);

                $this->routes[] = new Route(
                    (string) $routeElement->uri,
                    $this->namespace.'\\Controller\\'.((string) $routeElement->controller),
                    (string) $routeElement->action
                );
            }
        }

        $this->disposeContent();
    }

    /**
     * @param \SimpleXMLElement $routeElement
     * @throws InvalidXMLFormatException
     */
    private function checkRouteXMLSyntax(\SimpleXMLElement $routeElement) {
        if(empty($routeElement->uri)) {
            throw new InvalidXMLFormatException('Every <route> tag needs to have a child <uri> tag!');
        }

        if(empty($routeElement->controller)) {
            throw new InvalidXMLFormatException('Every <route> tag needs to have a child <controller> tag!');
        }

        if(empty($routeElement->action)) {
            throw new InvalidXMLFormatException('Every <route> tag needs to have a child <action> tag!');
        }
    }
}