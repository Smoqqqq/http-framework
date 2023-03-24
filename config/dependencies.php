<?php

// Configure here your service definitions

use App\Service\BarService;
use App\Service\FooService;
use Smoq\DependencyInjection\DependencyInjectionContainer;

$container = new DependencyInjectionContainer();

// Bad exemple : this here is useless, since the dependency injection can already figure that `FooService` as no dependency, and instanciate it by itself
$container->set(FooService::class, function () {
    return new FooService();
});

// Good exemple : here BarService requires additionnal configuration that cannot be automatically injected, and should therefore be configured
$container->set(BarService::class, function () {
    return new BarService(new FooService(), true);
});

// Set multiple dependencies at once 
$container->setMultiple([
    [
        BarService::class,
        function () {
            return new BarService(new FooService(), true);
        }
    ],[
        FooService::class,
        function () {
            return new FooService();
        }
    ]
]);
