<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Tests\Http;

use PHPUnit\Framework\TestCase;
use Smoq\Http\Request;

/**
 * @internal
 *
 * @coversNothing
 */
final class RequestTest extends TestCase
{
    private Request $request;

    protected function setUp(): void
    {
        $this->request = $this->createMock(Request::class);
    }

    public function testRequest(): void
    {
        static::assertIsArray($this->request->getServerInfo(), '$_SERVER isn\'t an array');
        static::assertIsArray($this->request->getQuery(), '$_POST isn\'t an array');
        static::assertIsArray($this->request->getParams(), '$_GET isn\'t an array');
        static::assertIsArray($this->request->getFiles(), '$_FILES isn\'t an array');
        static::assertIsArray($this->request->getCookies(), '$_COOKIE isn\'t an array');
        static::assertIsArray($this->request->getSession(), '$_SESSION isn\'t an array');
        static::assertIsArray($this->request->getRequest(), '$_REQUEST isn\'t an array');
        static::assertIsArray($this->request->getEnv(), '$_ENV isn\'t an array');
    }
}
