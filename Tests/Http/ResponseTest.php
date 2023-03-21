<?php


namespace Smoq\Tests\Http;

use Smoq\Http\Request;
use PHPUnit\Framework\TestCase;
use Smoq\Http\Response;

class ResponseTest extends TestCase {

    public function testRequest() {

        $response = new Response();

        $response->setContent("<h1>Hello world</h1>");
        $response->getHeaders()->set("Content-Type", "application/json");

        $this->assertEquals("<h1>Hello world</h1>", $response->getContent(), "Content didn't match");
        $this->assertEquals("application/json", $response->getHeaders()->get("Content-Type"), "Content didn't match");
    }
}