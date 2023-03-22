<?php

namespace Smoq\DependencyInjection;

use Exception;
use ReflectionClass;
use ReflectionMethod;
use ReflectionParameter;
use Smoq\DependencyInjection\Container;

class ParameterResolver
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function resolveClassMethodParams(object|string $class, string $method)
    {
        $reflexion = new ReflectionMethod($class, $method);

        $params = $reflexion->getParameters();
        $dependencies = [];

        foreach ($params as $param) {
            $dependencies[] = $this->resolveParam($param);
        }

        return $dependencies;
    }

    public function resolveParam(ReflectionParameter $param)
    {
        try {
            // Si il est enregistré en tant que service, on le récupère
            $dependency = $this->container->get($param->getType()->getName());
            return $dependency;
        } catch (\Exception) {
            if (!class_exists($param->getType()->getName())) {
                throw new Exception("Cannot autowire " . $param->getType()->getName() . ". please configure the container");
            }

            $className = $param->getType()->getName();
            $classReflection = new ReflectionClass($className);

            // Si il à un constructeur, on appel à nouveau la méthode `resolveClassMethodParams`
            if ($classReflection->hasMethod("__construct")) {
                $params = $this->resolveClassMethodParams($className, '__construct');
                return $this->instanciate($className, $params);
            }

            // Sinon on l'instancie direct
            return new $className();
        }
    }

    public function instanciate(string $className, array $params) {
        return new $className(...$params);
    }
}
