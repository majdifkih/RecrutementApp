<?php

namespace App\Controller;

use App\Repository\InternShipRepository;
use App\Repository\JobRepository;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(OffreRepository $offreRepository,JobRepository $jobRepository,InternShipRepository $internShipRepository): Response
    {
        $offers = $offreRepository->findBy([], ['id' => 'DESC']);
        $jobs = $jobRepository->findBy([],['id'=> 'DESC']);
        $internships = $internShipRepository->findBy([],['id'=>'DESC']);
        return $this->render('index.html.twig', [
            'controller_name' => 'HomePageController',
            'offres' => $offers,
            'jobs'=>$jobs,
            'internships'=>$internships

        ]);
    }


}
