<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeCandidatController extends AbstractController
{
    #[Route('/home/candidat', name: 'app_home_candidat')]
    public function index(): Response
    {
        return $this->render('home_candidat/index.html.twig', [
            'controller_name' => 'HomeCandidatController',
        ]);
    }
}
