<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\DependencyInjection;

use Smoq\ParameterBag\ParameterBag;

class DependencyInjectionContainer
{
    private static ParameterBag $dependencies;

    public function __construct()
    {
        static::$dependencies = new ParameterBag();
    }

    /**
     * Adds a dependency to the container
     * 
     * @param string $key the service name
     * @param callable $method the instanciation method. Must return
     * 
     * @return self
     */
    public function set(string $key, callable $method): self
    {
        static::$dependencies->set($key, $method);

        return $this;
    }

    /**
     * sets multiple dependencies in the container
     * 
     * @param array $dependencies
     * 
     * array must look like this :
     * 
     * ```php
     * [
     *      "key" => function () { return new MyDependency(...); },
     *      "key" => function () { return new MyDependency(...); },
     * ]
     * ```
     * 
     * @return self
     */
    public function setMultiple(array $dependencies): self
    {
        foreach ($dependencies as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    public function get(string $key)
    {
        return static::$dependencies->get($key)();
    }
}
