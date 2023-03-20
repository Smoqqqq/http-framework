<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http\Contracts;

interface RequestInterface
{
    public function getServerInfo(): array;

    public function getQuery(): array;

    public function getParams(): array;

    public function getFiles(): array;

    public function getCookies(): array;

    public function getSession(): array;

    public function getRequest(): array;

    public function getEnv(): array;
}
