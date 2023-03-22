<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace Smoq\Http\Controller;

use Smoq\Http\Response;
use Smoq\ParameterBag\ParameterBag;

class ErrorController
{
    public function error404()
    {
        $response = new Response(new ParameterBag(), 'Oops, an error occured !', 404);

        return new $response();
    }
}
