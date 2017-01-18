<?php

namespace Zwaldeck\Core\Kernel;

/**
 * Class AutoLoader
 * @package Zwaldeck\Core\Kernel
 */
class AutoLoader
{
    /**
     * @var string
     */
    private $rootDir;

    public function __construct()
    {
        spl_autoload_register(array($this, "autoLoad"));
        $this->rootDir = ROOT_DIR;
    }

    /**
     * @param string $class
     * @throws \Exception
     */
    public function autoLoad(string $class) {
        $class = str_replace('\\', '/', $class);
        $file = $this->rootDir."/../src/".$class.".php";

        if(!file_exists($file)) {
            throw new \Exception("Could not load '{$class}' because file '{$file}' does not exists!");
        }

        require_once $file;
    }

    /**
     * @return string
     */
    public function getRootDir(): string
    {
        return $this->rootDir;
    }
}