<?php

namespace Company\Plugins\FirstPlugin;

use Zwaldeck\Core\Plugin\Plugin;

/**
 * Class FirstPlugin
 * @package Company\Plugins\FirstPlugin
 */
class FirstPlugin extends Plugin
{

    public function getName(): string
    {
        return "FirstPlugin";
    }
}