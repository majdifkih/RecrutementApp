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
    #[Route('/home/candidat/{id}', name: 'app_home_candidat')]
    public function index(EntityManagerInterface $entityManager,$id): Response
    {
        $candidat = $entityManager->getRepository(Candidat::class)->find($id);
        $job = $entityManager->getRepository(Job::class)->findAll();
        $internship = $entityManager->getRepository(InternShip::class)->findAll();
        return $this->render('home_candidat/index.html.twig', [
            'controller_name' => 'HomeCandidatController',
            'candidat' => $candidat,
            'job' => $job,
            "internship"=>$internship,
        ]);
    }


    #[Route('/onecandidat/{id}', name: 'app_one_candidat')]
    public function getOneCandidat(Request $requestR, EntityManagerInterface $entityManager, $id): Response
    {
        // Récupérer le candidat par son ID
        $candidat = $entityManager->getRepository(Candidat::class)->find($id);

        if (!$candidat) {
            throw $this->createNotFoundException('Candidat non trouvé');
        }

        // Passer l'objet complet à la vue
        return $this->render('home_candidat/profil.html.twig', [
            'candidat' => $candidat,
        ]);
    }

}
