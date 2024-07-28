<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VueComponentController extends AbstractController
{
    #[Route('/vue/component', name: 'app_vue_component')]
        public function index(): Response
    {
        return $this->render('vue_component/index.html.twig', [
            'controller_name' => 'VueComponentController',
        ]);
    }
}
