<?php

namespace App\Controller;

use App\Service\BarService;
use Smoq\Http\Response;
use App\Service\FooService;
use Smoq\Http\Attributes\Route;
use Smoq\ParameterBag\ParameterBag;

class PageController {
    #[Route("/", "app_home")] 
    public function home(FooService $fooService, BarService $barService) {
        $fooService->sayHi();
        return new Response(new ParameterBag(), "<h1>Homepage</h1>");
    }
}