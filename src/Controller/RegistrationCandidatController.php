<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Recruiter;
use App\Entity\User;
use App\Form\CandidatType;
use App\Form\RecruiterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;



class RegistrationCandidatController extends AbstractController
{
    #[Route('/registration/candidat', name: 'app_registration_candidat')]
    public function registerRecruiter(Request $requestR, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $candidat = new Candidat();
        $formC = $this->createForm(CandidatType::class, $candidat);
        $formC->handleRequest($requestR);

        if ($formC->isSubmitted() && $formC->isValid()) {
//
            $candidat->setPassword(
                $userPasswordHasher->hashPassword(
                    $candidat,
                    $formC->get('plainPassword')->getData()
                )
            );

            $candidat->setRoles(['CANDIDAT']);

            $entityManager->persist($candidat);

            $entityManager->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('registration/RegisterCandidat.html.twig', [
            'canForm' => $formC->createView(),
        ]);
    }

}
