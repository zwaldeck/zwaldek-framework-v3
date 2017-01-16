<?php

namespace Zwaldeck\Core\Plugin;

/**
 * Class PluginManager
 * @package Zwaldeck\Core\Plugin
 */
class PluginManager
{
    /**
     * @var array
     */
    private $plugins;

    /**
     * PluginManager constructor.
     * @param array $plugins
     */
    public function __construct(array $plugins)
    {
        $this->plugins = $plugins;
    }

    public function getPlugins(): array {
        return $this->plugins;
    }

    /**
     * @param string $name
     * @return null|Plugin
     */
    public function getPlugin(string $name): ?Plugin {
        return $this->hasPlugin($name) ? $this->plugins[$name] : null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasPlugin(string $name): bool {
        return array_key_exists($name, $this->plugins);
    }
}