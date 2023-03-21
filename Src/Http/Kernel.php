<?php

namespace Smoq\Http;

use Dotenv\Dotenv;
use Smoq\Http\Router\Router;
use Smoq\Http\Controller\ControllerRegisterer;

class Kernel
{

    private array $env = [];

    public function __construct()
    {
        $this->env = $this->getEnv();

        $controllerRegisterer = new ControllerRegisterer($this->env["APP_ENV"]);
        $controllerRegisterer->register();

        $request = new Request();

        $currentRoute = Router::get($request->getRequestUri());
        $this->sendResponse($currentRoute);
    }

    private function getEnv() {
        $dotenv = Dotenv::createImmutable(getcwd());
        return $dotenv->load();
    }

    private function sendResponse(array $currentRoute) {
        $controller = new $currentRoute["controller"]();
        $controller[$currentRoute["method"]]();
    }
}
