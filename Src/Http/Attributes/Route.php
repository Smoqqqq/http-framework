<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http\Attributes;

use Attribute;

#[\Attribute]
class Route
{
    public function __construct(string $path, string $name)
    {
    }
}
