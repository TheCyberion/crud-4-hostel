<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Repository\SliderRepository;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HostelController extends AbstractController
{
    #[Route('/', name:'app_hostel')]
    public function index(SliderRepository $repo): Response
    {
        $slider = $repo->findAll();
        return $this->render('hostel/index.html.twig', [
            'photos' => $slider,
        ]);
    }

    #[Route('/chambres', name:'chambres')]
    public function chambres(ChambreRepository $repo): Response
    {
        // $chambres = $repo->FindAll();
        return $this->render('hostel/chambres.html.twig', [
            // 'chambres'=>$chambres
        ]);
    }

    #[Route('/cartes', name:'cartes')]
    public function cartes(): Response
    {
        return $this->render('hostel/cartes.html.twig');
    }

    #[Route('/spas', name:'spas')]
     public function spas()
    {
        return $this->render('hostel/spas.html.twig');
    }

    
    #[Route('/avis/filtre', name:'avis_filtre')]
    #[Route('/avis', name:'avis')]
    public function avis(EntityManagerInterface $manager, Request $globals, CommentaireRepository $repo, $categorie = null)
    {
        
        if($globals->request->get('category') != null){
            $category= $globals->request->get('category');
        }
        $avisFiltre= $repo->findBy(["category" => $category]);
        
        $avis = $repo->findAll();

        $comment = new Commentaire;
        $form=$this->createForm(AvisType::class, $comment);
        $form->handleRequest($globals);

        if($form->isSubmitted() && $form->isValid())
        {
            $comment->setDateEnregistrement(new \DateTime);
            $manager->persist($comment);
            $manager->flush();
            return $this->redirectToRoute("avis",[
                'avis' => $avis,
                'form' => $form,
            ]);
        }

        return $this->renderForm('hostel/avis.html.twig',[
            'avis' => $avis,
            'form' => $form,
            'category'=>$category,
            'filtre'=> $avisFiltre
        ]);
    }
    
}
