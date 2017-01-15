<?php

namespace Zwaldeck\Core\File;

/**
 * Class XmlFileLoader
 * @package Zwaldeck\Core\File
 */
class XmlFileLoader extends FileLoader
{
    public function loadFile(string $file): void
    {
        if (!$this->disposed) {
            $this->checkFile($file);

            $this->content = new \SimpleXMLElement(file_get_contents($file));
        }
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getContent(): \SimpleXMLElement
    {
        return $this->disposed || $this->content == null || $this->content == '' ? null : $this->content;
    }
}