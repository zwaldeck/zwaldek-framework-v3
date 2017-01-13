<?php

namespace Zwaldeck\Core\Kernel;
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
     * Kernel constructor.
     */
    public function __construct(string $rootDir, string $env, bool $debug)
    {
        $this->plugins = [];
        $this->rootDir = $rootDir;
        $this->env = $env;
        $this->debug = $debug;
        $this->booted = false;
    }

    public function boot(): void
    {
        if(!$this->booted) {

        }
    }

    /**
     * @return string
     */
    public function getRootDir(): string
    {
        return $this->rootDir;
    }

    public function handleRequest(Request $request): Response
    {
        if(!$this->booted) {
            $this->boot();
        }

        // TODO: Implement handleRequest() method.
    }


}