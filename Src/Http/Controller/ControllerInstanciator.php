<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http\Controller;

use Smoq\DependencyInjection\ParameterResolver;

class ControllerInstanciator
{
    public static function instanciate(array $currentRoute): void
    {
        $controller = new $currentRoute['controller']();

        $paramResolver = new ParameterResolver();

        $parameters = $paramResolver->resolveClassMethodParams($controller, $currentRoute['method']);

        $controller->{$currentRoute['method']}(...$parameters);
    }
}
