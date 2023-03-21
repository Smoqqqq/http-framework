<?php

namespace Smoq\Http\Router;

use Smoq\Http\Controller\ErrorController;

class Router
{
    static array $routes;

    public function __construct(private array $params = [])
    {
        static::$routes = $params;
    }

    /**
     * Gets the value associated with a key.
     * 
     * @param string|int $key the key looked for
     */
    public static function get(string|int $key): mixed
    {
        if (!\array_key_exists($key, static::$routes)) {
            return [
                "path" => $key,
                "name" => "__app_error_404",
                "controller" => ErrorController::class,
                "method" => "error404",
            ];
        }

        return static::$routes[$key];
    }

    /**
     * Sets a key value pair.
     *
     * @param string|int $key the key for this pair
     * @param mixed $value the value to store
     */
    public static function set(string|int $key, mixed $value): static
    {
        static::$routes[$key] = $value;

        return new static(static::$routes);
    }

    /**
     * Sets all routes
     *
     * @param array $routes the content of the bag
     */
    public static function setRoutes(array $routes): static
    {
        static::$routes = $routes;

        return new static(static::$routes);
    }

    /**
     * Gets all routes
     */
    public static function getRoutes(): array
    {
        return static::$routes;
    }
}
