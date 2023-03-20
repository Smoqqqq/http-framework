<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http\Contracts;

interface ResponseInterface
{
    public function getRequestHeaders(): array;

    public function getContent(): string;
}
