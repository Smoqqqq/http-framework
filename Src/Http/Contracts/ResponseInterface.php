<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http\Contracts;

use Smoq\ParameterBag\ParameterBag;

interface ResponseInterface
{
    public function getHeaders(): ParameterBag;
    public function setHeaders(ParameterBag $headers): self;

    public function getContent(): string;
    public function setContent(string $content): self;

    public function setStatusCode(int $statusCode): self;
    public function getStatusCode(): int;
}
