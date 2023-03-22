<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use ReflectionMethod;
use ReflectionParameter;
use Smoq\DependencyInjection\ParameterResolver;

/**
 * @internal
 *
 * @coversNothing
 */
final class ParameterResolverTest extends TestCase
{
    public function testResolveClassMethodParams(): void
    {
        $paramResolver = new ParameterResolver();
        $instanciateFooParams = $paramResolver->resolveClassMethodParams($this, 'instanciateFoo');
        $instanciateBarParams = $paramResolver->resolveClassMethodParams($this, 'instanciateBar');

        // Assert they have the same value (works even if they are not the same object, only value & type tested here)
        static::assertEquals([new FooService()], $instanciateFooParams, 'resolveClassMethodParams failed with instanciateFoo');
        static::assertEquals([new FooService(), new BarService(new FooService())], $instanciateBarParams, 'resolveClassMethodParams failed with');
    }

    public function testResolveParam(): void
    {
        $paramResolver = new ParameterResolver();

        $reflectionMethod = new ReflectionMethod($this, "instanciateFoo");
        $reflectionParam = $reflectionMethod->getParameters()[0];

        $instanciateFooParam = $paramResolver->resolveParam($reflectionParam);
        
        // Assert they have the same value (works even if they are not the same object, only value & type tested here)
        static::assertEquals(new FooService(), $instanciateFooParam, "resolveParam failed with instanciateFoo");
    }

    public function instanciateFoo(FooService $fooService): void
    {
    }

    public function instanciateBar(FooService $fooService, BarService $barService): void
    {
    }
}

class FooService
{
    public function __construct()
    {
    }

    public function sayHi(): void
    {
    }
}

class BarService
{
    public function __construct(FooService $fooService)
    {
    }
}
