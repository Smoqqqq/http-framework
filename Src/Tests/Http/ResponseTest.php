<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Tests\Http;

use PHPUnit\Framework\TestCase;
use Smoq\Http\Response;

/**
 * @internal
 *
 * @coversNothing
 */
final class ResponseTest extends TestCase
{
    public function testRequest(): void
    {
        $response = new Response();

        $response->setContent('<h1>Hello world</h1>');
        $response->getHeaders()->set('Content-Type', 'application/json');

        static::assertSame('<h1>Hello world</h1>', $response->getContent(), "Content didn't match");
        static::assertSame('application/json', $response->getHeaders()->get('Content-Type'), "Content didn't match");
    }
}
