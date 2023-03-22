<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace App\Controller;

use App\Service\BarService;
use App\Service\FooService;
use Smoq\Http\Attributes\Route;
use Smoq\Http\Controller\AbstractController;
use Smoq\Http\Response;
use Smoq\ParameterBag\ParameterBag;

class PageController extends AbstractController
{
    #[Route('/', 'app_home')]
    public function home(FooService $fooService, BarService $barService)
    {
        $fooService->sayHi();

        $this->renderRaw('<h1>Homepage</h1>');
    }
}
