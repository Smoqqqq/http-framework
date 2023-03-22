<?php

namespace Smoq\Http\Controller;

use Smoq\Env;
use Smoq\Http\Response;
use Smoq\ParameterBag\ParameterBag;

class AbstractController 
{
    public function render(string $templatePath, array $variables) {
        $engine = Env::get("TEMPLATING_ENGINE");
    }

    public function renderRaw(string $content = "", array $headers = [], int $statusCode = 200) {
        $response = new Response(new ParameterBag($headers), $content, $statusCode);
        $response->send();
    }
}