<?php

namespace Zwaldeck\Core\Http;

use Traversable;

/**
 * Class ParameterMap
 * @package Zwaldeck\Core\Http
 */
class ParameterMap implements \IteratorAggregate, \Countable
{

    /**
     * @var array
     */
    private $parameters;

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * @param array $parameters
     */
    public function addParameters(array $parameters): void {
        foreach ($parameters as $name => $value) {
            $this->parameters[$name] = $value;
        }
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addParameter(string $name, string $value): void {
        $this->parameters[$name] = $value;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool {
        return array_key_exists($key, $this->parameters);
    }

    /**
     * @param string $key
     * @return null|string
     */
    public function getParameter(string $key): ?string {
        return $this->has($key) ? $this->parameters[$key] : null;
    }

    public function remove(string $key): void {
        if($this->has($key)) {
            unset($this->parameters[$key]);
        }
    }

    /**
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->parameters);
    }

    /**
     * @return int The custom count as an integer.
     */
    public function count()
    {
        return count($this->parameters);
    }
}