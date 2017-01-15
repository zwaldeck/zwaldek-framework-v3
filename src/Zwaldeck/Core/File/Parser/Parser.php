<?php

namespace Zwaldeck\Core\File\Parser;


abstract class Parser
{
    /**
     * @var mixed
     */
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Dispose conent to free up memory
     * Only do this after parsing!
     */
    protected function disposeContent(): void
    {
        $this->content = null;
    }
}