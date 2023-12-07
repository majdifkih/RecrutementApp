<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Offre;
use App\Form\JobType;
use App\Form\RecruiterUpdateType;
use App\Repository\InternShipRepository;
use App\Repository\JobRepository;
use App\Repository\OffreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/dashboard')]
class HomeRecruteurController extends AbstractController
{


    #[Route('/', name: 'app_home_recruteur')]
    public function index(JobRepository $jobRepository,OffreRepository $offreRepository,InternShipRepository $internShipRepository): Response
    {
        $recruiter = $this->getUser();
        $recruiterId = $recruiter->getId();
        $totalOffres = $offreRepository->count(['recruiter' => $recruiterId]);
        $totalJobs = $jobRepository->count(['recruiter' => $recruiterId]);
        $totalInternships = $internShipRepository->count(['recruiter' => $recruiterId]);
//        $offersWithCandidates = $offreRepository->countOffersWithCandidates($recruiterId);
        return $this->render('home_recruteur/index.html.twig', [
            'controller_name' => 'HomeRecruteurController',
            'totalJobs' => $totalJobs,
            'totalOffres'=>$totalOffres,
            'totalInternShips'=>$totalInternships
//            'offersWithCandidates'=>$offersWithCandidates
        ]);
    }

    #[Route ('/alljobs',name:'get_all_jobs',methods: ['GET'])]
    public function allJobs(OffreRepository $offreRepository): Response
    {
        $recruiter = $this->getUser();
        return $this->render('home_recruteur/tables.html.twig', [
            'offers' => $offreRepository->findBy(['recruiter'=>$recruiter]),
        ]);
    }
    #[Route ('/edit/profile',name:'edit_profile_rec',methods: ['GET','POST'])]
        public function editRecruiter(Request $request,EntityManagerInterface $em):Response{
            $recruiter=$this->getUser();
            $form=$this->createForm(RecruiterUpdateType::class,$recruiter);
            $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('app_home_recruteur');
        }

        return $this->render('home_recruteur/updateprofile.html.twig', [
            'form' => $form->createView(),
        ]);
        }

}
