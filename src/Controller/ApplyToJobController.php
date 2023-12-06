<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\InternShip;
use App\Entity\Job;
use App\Entity\Offre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplyToJobController extends AbstractController
{
    // Controller action to handle job application
    #[Route('/apply/{id}', name: 'apply_to_job')]
    public function applyToJob(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $candidat = $this->getUser();
        $job = $entityManager->getRepository(Offre::class)->find($id);
        if ($candidat instanceof Candidat) {
            if (!$job->getCandidats()->contains($candidat)) {
                $job->addCandidat($candidat);
                $entityManager->flush();
                $this->addFlash('success', 'You have successfully applied for the job.');
            } else {
                $this->addFlash('warning', 'You have already applied for this job.');
            }
        } else {
            $this->addFlash('danger', 'Invalid candidat.');
        }
        return $this->redirectToRoute('app_job_index');
    }
}
