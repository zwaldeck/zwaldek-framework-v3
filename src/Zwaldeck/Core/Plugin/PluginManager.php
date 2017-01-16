<?php

namespace Zwaldeck\Core\Plugin;
use Zwaldeck\Core\Exceptions\PluginException;

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
     * @throws PluginException
     */
    public function __construct(array $plugins)
    {
        $this->plugins = [];

        foreach ($plugins as $plugin) {
            $class = get_class($plugin);
            if(!($plugin instanceof Plugin)) {
                throw new PluginException("The plugin with class '{$class}' does not extends Zwaldeck\\Core\\Plugin\\Plugin");
            }

            if(array_key_exists($plugin->getName(), $this->plugins)) {
                throw new PluginException("Can not load plugin with class '{$class}' ".
                "because another plugin with the same name '{$plugin->getName()}' was already found!");
            }

            $this->plugins[$plugin->getName()] = $plugin;
        }
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