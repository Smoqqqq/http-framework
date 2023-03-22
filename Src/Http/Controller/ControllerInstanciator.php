<?php

namespace Smoq\Http\Controller;

use Smoq\DependencyInjection\ParameterResolver;

class ControllerInstanciator
{
    public static function instanciate(array $currentRoute)
    {
        $controller = new $currentRoute["controller"]();

        $paramResolver = new ParameterResolver();

        $parameters = $paramResolver->resolveClassMethodParams($controller, $currentRoute["method"]);

        $controller->{$currentRoute["method"]}(...$parameters);
    }
}
