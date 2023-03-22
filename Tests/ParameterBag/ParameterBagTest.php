<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Tests\ParameterBag;

use PHPUnit\Framework\TestCase;
use Smoq\ParameterBag\ParameterBag;

/**
 * @internal
 *
 * @coversNothing
 */
final class ParameterBagTest extends TestCase
{
    public function testRequest(): void
    {
        $bag = new ParameterBag();

        $bag->set('param1', 'Parameter 1')
            ->set('param2', [1, 2, 3])
        ;

        static::assertSame('Parameter 1', $bag->get('param1'), "String param didn't match".$bag->get('param1'));
        static::assertSame([1, 2, 3], $bag->get('param2'), "Array param didn't match");

        $bag->setParams(['test', 123, null]);

        static::assertSame([0 => 'test', 1 => 123, 2 => null], $bag->getParams(), "Params didn't match expected");

        $bag->set('new', 'value');

        static::assertSame([0 => 'test', 1 => 123, 2 => null, 'new' => 'value'], $bag->getParams(), "Params didn't match expected");

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Key 'unknow_param' does not exist in the parameter bag");
        $bag->get('unknow_param');
    }
}
