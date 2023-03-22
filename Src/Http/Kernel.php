<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http;

use Dotenv\Dotenv;
use Smoq\Http\Controller\ControllerInstanciator;
use Smoq\Http\Controller\ControllerRegisterer;
use Smoq\Http\Router\Router;

class Kernel
{
    private array $env = [];

    public function __construct()
    {
        $this->env = $this->getEnv();

        $controllerRegisterer = new ControllerRegisterer($this->env['APP_ENV']);
        $controllerRegisterer->register();

        $request = new Request();

        $currentRoute = Router::get($request->getRequestUri());
        $this->sendResponse($currentRoute);
    }

    private function getEnv()
    {
        $dotenv = Dotenv::createImmutable(getcwd());

        return $dotenv->load();
    }

    private function sendResponse(array $currentRoute): void
    {
        ControllerInstanciator::instanciate($currentRoute);
    }
}
