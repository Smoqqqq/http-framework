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

class HomeController extends AbstractController
{
    #[Route('/home', 'app_homepage')]
    public function home(FooService $fooService, BarService $barService)
    {
        $items = [
            "hello",
            "I",
            "am",
            "Paul"
        ];

        return $this->render("index.html.twig", [
            "items" => $items
        ]);
    }
}
