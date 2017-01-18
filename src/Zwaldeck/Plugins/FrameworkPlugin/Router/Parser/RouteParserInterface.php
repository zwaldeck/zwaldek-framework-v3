<?php

namespace Zwaldeck\Plugins\FrameworkPlugin\Router\Parser;


use Zwaldeck\Core\File\Parser\ParserInterface;

interface RouteParserInterface extends ParserInterface
{
    public function getRoutes(): array;
}