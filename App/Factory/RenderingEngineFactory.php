<?php

namespace App\Factory;

use App\Rendering\TwigEngine;
use Smoq\Rendering\Contracts\RenderingEngineFactoryInterface;
use Smoq\Rendering\Contracts\RenderingEngineInterface;

class RenderingEngineFactory implements RenderingEngineFactoryInterface
{
    public function create(): RenderingEngineInterface
    {
        return new TwigEngine();
    }
}
