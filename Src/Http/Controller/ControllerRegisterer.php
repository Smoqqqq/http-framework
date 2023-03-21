<?php

namespace Smoq\Http\Controller;

use ReflectionClass;
use Smoq\Http\Route;
use Smoq\Http\Router\Router;
use Smoq\Http\Router\RouteCacher;

class ControllerRegisterer
{

    private string $baseDir;

    public function __construct(private string $appEnv)
    {
        $this->baseDir = getcwd() . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "Controller";
    }

    private function getFiles()
    {
        $files = array_diff(scandir($this->baseDir), [".", ".."]);

        return $files;
    }

    public function register()
    {

        if ($this->appEnv === "prod") {
            $routes = RouteCacher::getCachedRoutes();
            $routes = unserialize($routes);

            Router::setRoutes($routes);
            return;
        }

        $files = $this->getFiles();
        $routes = [];

        foreach ($files as $file) {

            require_once($this->baseDir . DIRECTORY_SEPARATOR . $file);

            $className = str_replace(".php", "", $file);
            $fullClassName = "App\\Controller\\" . $className;

            $reflexion = new ReflectionClass($fullClassName);
            $methods = $reflexion->getMethods();

            foreach ($methods as $method) {
                $attributes = $method->getAttributes(Route::class);
                if (!empty($attributes)) {
                    foreach ($attributes as $attribute) {
                        [$path, $name] = $attribute->getArguments();

                        $route = [
                            "path" => $path,
                            "name" => $name,
                            "controller" => $fullClassName,
                            "method" => $method->getName(),
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
}
