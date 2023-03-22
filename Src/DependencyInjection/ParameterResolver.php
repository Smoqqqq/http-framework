<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\DependencyInjection;

class ParameterResolver
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function resolveClassMethodParams(object|string $class, string $method)
    {
        $reflexion = new \ReflectionMethod($class, $method);

        $params = $reflexion->getParameters();
        $dependencies = [];

        foreach ($params as $param) {
            $dependencies[] = $this->resolveParam($param);
        }

        return $dependencies;
    }

    public function resolveParam(\ReflectionParameter $param)
    {
        try {
            // Si il est enregistré en tant que service, on le récupère
            return $this->container->get($param->getType()->getName());
        } catch (\Exception) {
            if (!class_exists($param->getType()->getName())) {
                throw new \Exception('Cannot autowire '.$param->getType()->getName().'. please configure the container');
            }

            $className = $param->getType()->getName();
            $classReflection = new \ReflectionClass($className);

            // Si il à un constructeur, on appel à nouveau la méthode `resolveClassMethodParams`
            if ($classReflection->hasMethod('__construct')) {
                $params = $this->resolveClassMethodParams($className, '__construct');

                return $this->instanciate($className, $params);
            }

            // Sinon on l'instancie direct
            return new $className();
        }
    }

    public function instanciate(string $className, array $params)
    {
        return new $className(...$params);
    }
}
