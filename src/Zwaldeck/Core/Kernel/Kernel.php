<?php

namespace Zwaldeck\Core\Kernel;
use Zwaldeck\Core\DependencyInjection\Container;
use Zwaldeck\Core\DependencyInjection\ContainerInterface;
use Zwaldeck\Core\DependencyInjection\Service\ServiceLoader;
use Zwaldeck\Core\File\Parser\XML\XMLConfigParser;
use Zwaldeck\Core\File\Parser\XML\XMLServiceParser;
use Zwaldeck\Core\File\XmlFileLoader;
use Zwaldeck\Core\Http\Request;
use Zwaldeck\Core\Http\Response;
use Zwaldeck\Core\Plugin\Plugin;
use Zwaldeck\Core\Plugin\PluginManager;

/**
 * Class Kernel
 * @package Zwaldeck\Core\Kernel
 */
abstract class Kernel implements KernelInterface
{
    const VERSION = "Pre-Alpha 0.0.1";

    /**
     * @var PluginManager
     */
    protected $pluginManager;

    /**
     * @var string
     */
    protected $env;

    /**
     * @var bool
     */
    protected $debug;

    /**
     * @var string
     */
    protected $rootDir;

    /**
     * @var bool
     */
    protected $booted;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Kernel constructor.
     */
    public function __construct(string $rootDir, string $env, bool $debug)
    {
        $this->pluginManager = null;
        $this->config = [];
        $this->rootDir = $rootDir;
        $this->env = $env;
        $this->debug = $debug;
        $this->booted = false;
        $this->container = null;
    }

    public function boot(): void
    {
        if(!$this->booted) {
            $this->container = new Container();

            $this->pluginManager = new PluginManager($this->loadPlugins());

            $this->loadConfig();

            //TODO before loading services we need to load in all the plugins
            $this->loadServices();
        }
    }

    /**
     * @return string
     */
    public function getRootDir(): string
    {
        return $this->rootDir;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handleRequest(Request $request): Response
    {
        if(!$this->booted) {
            $this->boot();
        }

        // TODO: Implement handleRequest() method.
    }

    private function loadConfig() {
        $fileLoader = new XmlFileLoader();
        $fileLoader->loadFile($this->rootDir.'/../app/config.xml');
        $configParser = new XMLConfigParser($fileLoader->getContent());
        $configParser->parse();
        $this->config = $configParser->getConfig();

        $fileLoader = null;
        $configParser = null;
    }

    private function loadServices() {
        //TODO change to work with plugins

        $parameters = [];
        $servicesToLoad = [];
        /** @var Plugin $plugin */
        foreach ($this->pluginManager->getPlugins() as $plugin) {
            $servicesToLoad = array_merge($servicesToLoad, $plugin->getServiceParser()->getServices());
            $parameters = array_merge($parameters, $plugin->getServiceParser()->getParameters());
        }

        foreach ($parameters as $name => $value) {
            $this->container->addParameter($name, $value);
        }

        $serviceLoader = new ServiceLoader($servicesToLoad);
        $serviceLoader->loadServices($this->container);

        $this->container->freeze();

        var_dump($this->container->getParameters());
        var_dump($this->container->getServices());
    }

}