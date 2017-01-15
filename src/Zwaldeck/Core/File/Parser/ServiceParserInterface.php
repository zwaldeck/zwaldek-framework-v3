<?php

namespace Zwaldeck\Core\File\Parser;

/**
 * interface ServiceParserInterface
 * @package Zwaldeck\Core\File\Parser
 */
interface ServiceParserInterface extends ParserInterface
{
    public function getServices();
    public function getParameters();
}