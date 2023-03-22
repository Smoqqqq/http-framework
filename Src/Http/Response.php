<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http;

use Smoq\Http\Contracts\ResponseInterface;
use Smoq\ParameterBag\Contracts\ParameterBagInterface;
use Smoq\ParameterBag\ParameterBag;

class Response implements ResponseInterface
{
    public function __construct(private ParameterBagInterface $headers = new ParameterBag(), private string $content = '', private int $statusCode = 200)
    {
    }

    public function setHeaders(ParameterBagInterface $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function getHeaders(): ParameterBag
    {
        return $this->headers;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);
        foreach ($this->headers->getParams() as $key => $value) {
            header("{$key}: {$value}");
        }

        echo $this->content;
    }
}
