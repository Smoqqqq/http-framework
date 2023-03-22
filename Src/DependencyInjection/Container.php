<?php

namespace Smoq\DependencyInjection;

use Smoq\ParameterBag\ParameterBag;

class Container {

    private static ParameterBag $dependencies;

    public function __construct()
    {
        static::$dependencies = new ParameterBag();
    }

    public function set(string $key, callable $method) {
        static::$dependencies->set($key, $method);
    }

    public function get(string $key) {
        return static::$dependencies->get($key)();
    }
}