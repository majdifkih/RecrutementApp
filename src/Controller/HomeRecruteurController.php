<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeRecruteurController extends AbstractController
{
    #[Route('/home/recruteur', name: 'app_home_recruteur')]
    public function index(): Response
    {
        return $this->render('home_recruteur/index.html.twig', [
            'controller_name' => 'HomeRecruteurController',
        ]);
    }
}
