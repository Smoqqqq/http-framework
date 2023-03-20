<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http;

use Smoq\Http\Contracts\RequestInterface;

class Request implements RequestInterface
{
    private array|null $serverInfo;
    private array|null $query;
    private array|null $params;
    private array|null $files;
    private array|null $cookies;
    private array|null $session;
    private array|null $request;
    private array|null $env;

    public function __construct()
    {
        session_start();

        $this->serverInfo = $_SERVER;
        $this->params = $_POST;
        $this->query = $_GET;
        $this->files = $_FILES;
        $this->cookies = $_COOKIE;
        $this->session = $_SESSION;
        $this->request = $_REQUEST;
        $this->env = $_ENV;
    }

    public function getServerInfo(): array
    {
        return $this->serverInfo;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getCookies(): array
    {
        return $this->cookies;
    }

    public function getSession(): array
    {
        return $this->session;
    }

    public function getRequest(): array
    {
        return $this->request;
    }

    public function getEnv(): array
    {
        return $this->env;
    }
}
