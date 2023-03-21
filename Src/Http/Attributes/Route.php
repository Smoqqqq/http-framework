<?php

namespace Smoq\Http\Attributes;

use Attribute;

#[Attribute]
class Route {
    public function __construct(string $path, string $name)
    {
    }
}