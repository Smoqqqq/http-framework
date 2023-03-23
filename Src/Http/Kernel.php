<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http;

use Smoq\Env\Env;
use Dotenv\Dotenv;
use Smoq\Env\DefaultEnvironment;
use Smoq\Http\Router\Router;
use Smoq\Http\Controller\ControllerRegisterer;
use Smoq\Http\Controller\ControllerInstanciator;

class Kernel
{
    public function __construct()
    {
        $this->getEnv();
        $this->handleRouting();
    }

    /**
     * Gets .env varia.
     */
    private function getEnv()
    {
        $dotenv = Dotenv::createImmutable(getcwd());

        DefaultEnvironment::setDefaults();
        Env::addVariables($dotenv->load());
    }

    /**
     * initiates routing & http response.
     */
    private function handleRouting(): void
    {
        $controllerRegisterer = new ControllerRegisterer();
        $controllerRegisterer->register();

        $request = new Request();

        $currentRoute = Router::get($request->getRequestUri());
        ControllerInstanciator::instanciate($currentRoute);
    }
}
