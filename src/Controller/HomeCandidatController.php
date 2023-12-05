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

    #[Route('/edit/candidat', name: 'app_edit_candidat', methods: ['GET', 'POST'])]
    public function editCandidat(Request $request): Response
    {
        $candidat = $this->getUser();

        // Créer le formulaire
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer les modifications dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            // Rediriger vers la page de profil ou une autre page après l'édition
            return $this->redirectToRoute('app_profil');
        }

        // Passer le formulaire à la vue
        return $this->render('home_candidat/updateprofil.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
