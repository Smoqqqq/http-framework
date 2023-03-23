<?php

namespace Smoq\Rendering;

use Smoq\Http\Response;
use Smoq\ParameterBag\ParameterBag;
use Smoq\DependencyInjection\ParameterResolver;
use Smoq\Rendering\Contracts\RenderingEngineInterface;
use Smoq\Rendering\Exception\NoRenderingEngineSetException;

class AbstractRenderer
{
    public static function render(string $templatePathOrHtml, array $templateVariables = [], array $headers = [], int $statusCode = 200)
    {
        $factoryClassName = "App\\Factory\\RenderingEngineFactory";

        if (class_exists($factoryClassName)) {
            $paramResolver = new ParameterResolver();

            $parameters = $paramResolver->resolveClassMethodParams($factoryClassName, "__construct");

            /** @var  */
            $factory = new $factoryClassName($parameters);
            
            /** @var RenderingEngineInterface */
            $engine = $factory->create();

            $content = $engine->render($templatePathOrHtml, $templateVariables);

            $response = new Response(new ParameterBag($headers), $content, $statusCode);
            $response->send();
        } else {
            throw new NoRenderingEngineSetException("No rendering engine factory found. Please provide a `RenderingEngineFactory` class (App\Factory\RenderingEngineFactory) that instanciates an rendering engine (extend RenderingEngineInterface)");
        }
    }
}
