<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationRecruiterController extends AbstractController
{
    #[Route('/registration/recruiter', name: 'app_registration_recruiter')]
    public function index(): Response
    {
        return $this->render('registration_recruiter/index.html.twig', [
            'controller_name' => 'RegistrationRecruiterController',
        ]);
    }
}
