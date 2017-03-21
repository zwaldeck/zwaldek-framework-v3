<?php

namespace Zwaldeck\Plugins\ORMPlugin;

use Zwaldeck\Core\Plugin\Plugin;

/**
 * Class ORMPlugin
 * @package Zwaldeck\Plugins\ORMPlugin
 */
class DBALPlugin extends Plugin
{
    public function getName(): string
    {
        return "ZwaldeckDBALPlugin";
    }
}