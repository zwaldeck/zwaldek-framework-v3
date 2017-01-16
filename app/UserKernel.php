<?php

use Company\Plugins\FirstPlugin\FirstPlugin;
use Zwaldeck\Core\Kernel\Kernel;
use Zwaldeck\Plugins\FrameworkPlugin\FrameworkPlugin;

class UserKernel extends Kernel
{
    public function loadPlugins(): array
    {
        $plugins = [];
        $plugins[] = new FrameworkPlugin();
        $plugins[] = new FirstPlugin();

        return $plugins;
    }
}