<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http;

use Smoq\ParameterBag\ParameterBag;

class Response
{
    private ParameterBag $headers;
    private string $content = '';

    public function setHeaders(array $headers): void
    {
    }
}
