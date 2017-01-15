<?php

namespace Zwaldeck\Core\File\Parser\XML;

use Zwaldeck\Core\File\Parser\ConfigParser;
use Zwaldeck\Core\File\XmlFileLoader;

/**
 * Class XMLConfigParser
 * @package Zwaldeck\Core\File\Parser\XML
 */
class XMLConfigParser extends ConfigParser
{
    public function parse()
    {
        $this->config = json_decode(json_encode($this->content), true);
    }
}