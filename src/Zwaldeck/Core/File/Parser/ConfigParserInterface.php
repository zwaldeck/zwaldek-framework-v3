<?php

namespace Zwaldeck\Core\File\Parser;

/**
 * Interface ConfigParserInterface
 * @package Zwaldeck\Core\File\Parser
 */
interface ConfigParserInterface extends ParserInterface
{
    public function getConfig();
}