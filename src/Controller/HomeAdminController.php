<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeAdminController extends AbstractController
{
    #[Route('/dashboard/admin', name: 'app_home_admin')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('home_admin/index.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }
}
