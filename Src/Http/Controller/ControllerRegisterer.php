<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http\Controller;

use Smoq\Env\Env;
use Smoq\Http\Router\Router;
use Smoq\Http\Attributes\Route;
use Smoq\Http\Router\RouteCacher;

class ControllerRegisterer
{
    private string $baseDir;
    private string $appEnv;

    public function __construct()
    {
        $this->appEnv = Env::get("APP_ENV");
        $this->baseDir = getcwd().\DIRECTORY_SEPARATOR.'App'.\DIRECTORY_SEPARATOR.'Controller';
    }

    public function register(): void
    {
        if ('prod' === $this->appEnv) {
            $routes = RouteCacher::getCachedRoutes();
            $routes = unserialize($routes);

            Router::setRoutes($routes);

            return;
        }

        $files = $this->getFiles();
        $routes = [];

        foreach ($files as $file) {
            require_once $this->baseDir.\DIRECTORY_SEPARATOR.$file;

            $className = str_replace('.php', '', $file);
            $fullClassName = 'App\\Controller\\'.$className;

            $reflexion = new \ReflectionClass($fullClassName);
            $methods = $reflexion->getMethods();

            foreach ($methods as $method) {
                $attributes = $method->getAttributes(Route::class);
                if (!empty($attributes)) {
                    foreach ($attributes as $attribute) {
                        [$path, $name] = $attribute->getArguments();
                        $parameters = [];

                        foreach ($method->getParameters() as $param) {
                            $parameters[] = [
                                'name' => $param->getName(),
                                'position' => $param->getPosition(),
                                'typeHint' => $param->getType()->getName(),
                            ];
                        }

                        $route = [
                            'path' => $path,
                            'name' => $name,
                            'controller' => $fullClassName,
                            'method' => $method->getName(),
                            'parameters' => $parameters,
                        ];

                        $routes[$path] = $route;
                    }
                }
            }
        }

        Router::setRoutes($routes);

        $routeCacher = new RouteCacher();
        $routeCacher->cache($routes);
    }

    private function getFiles()
    {
        return array_diff(scandir($this->baseDir), ['.', '..']);
    }
}
