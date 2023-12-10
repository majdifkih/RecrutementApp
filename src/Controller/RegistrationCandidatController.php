<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Recruiter;
use App\Entity\User;
use App\Form\CandidatType;
use App\Form\RecruiterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
            $cvfile=$formC->get('cv')->getData();
            if ($cvfile) {
                $newFilename = uniqid().'.'.$cvfile->guessExtension();
                // Move the file to the upload directory
                $cvfile->move(
                    $this->getParameter('files_directory'),
                    $newFilename
                );
                // Update the cv property in the entity
                $candidat = $formC->getData();
                $candidat->setCv($newFilename);
            }

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
