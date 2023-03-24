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
use Smoq\Orm\DoctrineOrm;

class PageController extends AbstractController
{
    #[Route('/', 'app_home')]
    public function home(DoctrineOrm $doctrine)
    {
        $em = $doctrine->getManager();
        $todo = new Todo();
        $todo->setTitle("Faire le ménage")
            ->setDescription("Nettoyer partout !");

        $em->persist($todo);
        $em->flush();

        return $this->render("index.html.twig");
    }
}
