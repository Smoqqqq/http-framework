<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Rendering\Contracts;

interface RenderingEngineInterface
{
    /**
     * renders a template.
     */
    public function render(string $templatePath, array $variables): string;
}
