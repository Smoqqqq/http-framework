<?php

namespace App\Controller;

use ReflectionException;
use Smoq\Http\Response;
use Smoq\Http\Route;
use Smoq\ParameterBag\ParameterBag;

class PageController {
    #[Route("/", "app_home")] 
    public function home(int $count) {
        return new Response(new ParameterBag(), "<h1>Homepage</h1>");
    }
}