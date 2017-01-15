<?php

namespace Zwaldeck\Core\DependencyInjection\Service;


class ConstructorArgument
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var mixed
     */
    private $argument;

    /**
     * ConstructorArgument constructor.
     * @param $type
     * @param $argument
     */
    public function __construct(string $type, $argument)
    {
        if(!ConstructorArgumentType::validType($type)) {
            throw new \InvalidArgumentException("The constructor argument type '{$type}' is not a valid type!");
        }

        $this->type = $type;
        $this->argument = $argument;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getArgument()
    {
        return $this->argument;
    }
}