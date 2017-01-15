<?php

namespace Zwaldeck\Core\File;

use Zwaldeck\Core\Exceptions\FileNotFoundException;

/**
 * Class FileLoader
 * @package Zwaldeck\Core\File
 */
abstract class FileLoader implements FileLoaderInterface
{
    /**
     * @var mixed
     */
    protected $content;

    /**
     * @var string
     */
    protected $disposed = false;

    /**
     * @param string $file
     */
    public abstract function loadFile(string $file): void;

    /**
     * @return mixed
     */
    public abstract function getContent();

    /**
     * @param string $file
     * @throws FileNotFoundException
     */
    public function checkFile(string $file): void
    {
        if (!file_exists($file)) {
            throw new FileNotFoundException($file);
        }
    }

    public function dispose(): void
    {
        $this->content = null;
        $this->disposed = true;
    }
}