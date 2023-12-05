<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\InternShip;
use App\Entity\Job;
use App\Form\CandidatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;
class HomeCandidatController extends AbstractController
{
    #[Route('/home/candidat', name: 'app_home_candidat')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $candidat = $this->getUser();
        $job = $entityManager->getRepository(Job::class)->findAll();
        $internship = $entityManager->getRepository(InternShip::class)->findAll();
        return $this->render('home_candidat/index.html.twig', [
            'controller_name' => 'HomeCandidatController',
            'candidat' => $candidat,
            'job' => $job,
            "internship"=>$internship,
        ]);
    }


    #[Route('/onecandidat', name: 'app_one_candidat')]
    public function getOneCandidat(): Response
    {
        // Récupérer le candidat par son ID
        $candidat = $this->getUser();


        // Passer l'objet complet à la vue
        return $this->render('home_candidat/profil.html.twig', [
            'candidat' => $candidat,
        ]);
    }

}
