<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Recruiter;
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
            // encode the plain password
            $candidat->setPassword(
                $userPasswordHasher->hashPassword(
                    $candidat,
                    $formC->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($candidat);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home_candidat');
        }
        return $this->render('registration/RegisterCandidat.html.twig', [
            'canForm' => $formC->createView(),
        ]);
    }
}
