<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
use App\Repository\OffreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/dashboard')]
class HomeRecruteurController extends AbstractController
{
    #[Route('/', name: 'app_home_recruteur')]
    public function index(): Response
    {
        return $this->render('home_recruteur/index.html.twig', [
            'controller_name' => 'HomeRecruteurController',
        ]);
    }

    #[Route ('/alljobs',name:'get_all_jobs',methods: ['GET'])]
    public function allJobs(OffreRepository $offreRepository): Response
    {
        return $this->render('home_recruteur/tables.html.twig', [
            'offers' => $offreRepository->findAll(),
        ]);
    }

}
