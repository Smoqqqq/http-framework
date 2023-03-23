<?php

namespace Smoq\Http\Controller;

use Smoq\Env\Env;
use Smoq\Http\Controller\Exception\NoRenderingEngineSetException;
use Smoq\Http\Response;
use Smoq\ParameterBag\ParameterBag;
use Smoq\Rendering\AbstractRenderer;

class AbstractController 
{
    public function render(string $template, array $variables = [], array $headers = [], int $statusCode = 200) {
        AbstractRenderer::render($template, $variables, $headers, $statusCode);
    }

    public function renderRaw(string $content = "", array $headers = [], int $statusCode = 200) {
        $response = new Response(new ParameterBag($headers), $content, $statusCode);
        $response->send();
    }
}