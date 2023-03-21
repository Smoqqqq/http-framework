<?php

namespace Smoq\Http\Controller;

use Smoq\Http\Response;
use Smoq\ParameterBag\ParameterBag;

class ErrorController {
    public function error404() {
        
        $response = new Response(new ParameterBag(), "Oops, an error occured !", 404);
        
        return new $response;
    }
}