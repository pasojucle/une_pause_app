<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultContollerController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(): Response
    {
        //test
        return $this->render('default_contoller/index.html.twig', [
            'controller_name' => 'DefaultContollerController',
        ]);
    }
}
