<?php

namespace App\Controller;

use App\Entity\Recruiter;
use App\Entity\User;
use App\Form\RecruiterType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationRecruiterController extends AbstractController
{
    #[Route('/registration/recruiter', name: 'app_registration_recruiter')]
    public function registerRecruiter(Request $requestR, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $rec = new Recruiter();
        $formR = $this->createForm(RecruiterType::class, $rec);
        $formR->handleRequest($requestR);

        if ($formR->isSubmitted() && $formR->isValid()) {
            // encode the plain password
            $rec->setPassword(
                $userPasswordHasher->hashPassword(
                    $rec,
                    $formR->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($rec);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home_recruteur');
        }
        return $this->render('registration/RegisterRecruiter.html.twig', [
            'recForm' => $formR->createView(),
        ]);
    }
}
