<?php

namespace Zwaldeck\Core\File;

/**
 * Class FileLoaderInterface
 * @package Zwaldeck\Core\File
 */
interface FileLoaderInterface
{
    public function checkFile(string $file);
    public function loadFile(string $file);
    public function dispose();
}