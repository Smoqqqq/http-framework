<?php

declare(strict_types=1);

/*
 * This file is part of **FRAMEWORK**
 * Author Paul Le Flem <contact@paul-le-flem.fr>
 */

namespace App\Controller;

use App\Entity\Todo;
use Smoq\Http\Attributes\Route;
use Smoq\Http\Controller\AbstractController;
use Smoq\Http\Request;
use Smoq\Orm\DoctrineOrm;

class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo_search')]
    public function search()
    {
        return $this->render("pages/index.html.twig");
    }

    #[Route('/nouveau', name: "app_todo_create")]
    public function create(DoctrineOrm $doctrine, Request $request) {
        dd($request);

        $em = $doctrine->getManager();

        $todo = new Todo();
        
    }
}
