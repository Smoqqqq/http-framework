<?php


namespace Smoq\Tests\Http;

use Smoq\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase {

    private Request $request;

    public function setUp(): void
    {
        $this->request = $this->createMock(Request::class);
    }

    public function testRequest() {
        $this->assertIsArray($this->request->getServerInfo(), '$_SERVER isn\'t an array');
        $this->assertIsArray($this->request->getQuery(), '$_POST isn\'t an array');
        $this->assertIsArray($this->request->getParams(), '$_GET isn\'t an array');
        $this->assertIsArray($this->request->getFiles(), '$_FILES isn\'t an array');
        $this->assertIsArray($this->request->getCookies(), '$_COOKIE isn\'t an array');
        $this->assertIsArray($this->request->getSession(), '$_SESSION isn\'t an array');
        $this->assertIsArray($this->request->getRequest(), '$_REQUEST isn\'t an array');
        $this->assertIsArray($this->request->getEnv(), '$_ENV isn\'t an array');
    }
}