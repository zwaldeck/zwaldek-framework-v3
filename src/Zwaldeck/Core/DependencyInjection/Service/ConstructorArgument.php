<?php

namespace Zwaldeck\Core\DependencyInjection\Service;


class ConstructorArgument
{
    /**
     * @var ConstructorArgumentType
     */
    private $type;

    /**
     * @var string
     */
    private $argument;

    /**
     * ConstructorArgument constructor.
     * @param $type
     * @param $argument
     */
    public function __construct(ConstructorArgumentType $type, string $argument)
    {
        $this->type = $type;
        $this->argument = $argument;
    }

    /**
     * @return ConstructorArgumentType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getArgument()
    {
        return $this->argument;
    }
}