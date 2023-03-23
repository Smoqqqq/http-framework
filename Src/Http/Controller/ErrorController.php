<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http\Controller;

use Smoq\Http\Response;
use Smoq\ParameterBag\ParameterBag;

class ErrorController extends AbstractController
{
    public function error404()
    {
        $this->renderRaw("<h1>An error occured</h1><p>The page could not be found</p>");
    }
}
