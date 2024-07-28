<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JouetController extends AbstractController
{
    #[Route('/jouet', name: 'app_jouet')]
    public function index(): Response
    {
        return $this->render('jouet/index.html.twig', [
            'controller_name' => 'JouetController',
        ]);
    }
}
