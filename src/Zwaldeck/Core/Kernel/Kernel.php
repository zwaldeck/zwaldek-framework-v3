<?php

namespace Zwaldeck\Core\Kernel;
use Zwaldeck\Core\File\Parser\XML\XMLConfigParser;
use Zwaldeck\Core\File\XmlFileLoader;
use Zwaldeck\Core\Http\Request;
use Zwaldeck\Core\Http\Response;

/**
 * Class Kernel
 * @package Zwaldeck\Core\Kernel
 */
abstract class Kernel implements KernelInterface
{
    const VERSION = "Pre-Alpha 0.0.1";

    /**
     * @var array
     */
    protected $plugins;

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
     * Kernel constructor.
     */
    public function __construct(string $rootDir, string $env, bool $debug)
    {
        $this->plugins = [];
        $this->config = [];
        $this->rootDir = $rootDir;
        $this->env = $env;
        $this->debug = $debug;
        $this->booted = false;
    }

    public function boot(): void
    {
        if(!$this->booted) {
            $this->loadConfig();
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
    }


}