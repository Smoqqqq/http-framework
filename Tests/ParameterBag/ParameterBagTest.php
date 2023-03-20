<?php


namespace Smoq\Tests\ParameterBag;

use PHPUnit\Framework\TestCase;
use Smoq\ParameterBag\ParameterBag;
use Smoq\ParameterBag\UnknownKeyException;

class ParameterBagTest extends TestCase {
    
    public function testRequest() {
        $bag = new ParameterBag();

        $bag->set("param1", "Parameter 1")
            ->set("param2", [1, 2, 3]);

        $this->assertEquals("Parameter 1", $bag->get("param1"), "String param didn't match" . $bag->get("param1"));
        $this->assertEquals([1, 2, 3], $bag->get("param2"), "Array param didn't match");

        $bag->setParams(["test", 123, null]);
        
        $this->assertEquals([0 => "test", 1 => 123, 2 => null], $bag->getParams(), "Params didn't match expected");
        
        $bag->set("new", "value");
        
        $this->assertEquals([0 => "test", 1 => 123, 2 => null, "new" => "value"], $bag->getParams(), "Params didn't match expected");
        
        $this->expectException(UnknownKeyException::class);
        $bag->get("unknow_param");

    }
}