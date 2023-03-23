<?php

namespace Smoq\Rendering\Contracts;

interface RenderingEngineFactoryInterface {
    public function create(): RenderingEngineInterface;
}