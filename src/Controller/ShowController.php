<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowController extends AbstractController
{
     #[Route('/show', name: 'app_show')]
     public function index(): Response
     {
         return $this->render('show/index.html.twig', [
             'controller_name' => 'ShowController',
         ]);
     }

    #[Route('/show/chambre/{id}', name: 'show_chambre')]
    public function Chambre($id, ChambreRepository $repo, EntityManagerInterface $manager, Request $globals): Response
    {
        $chambre = $repo->find($id);
        

        
            $commande = new Commande;
            
            $form = $this->createForm(CommandeType::class, $commande);
            
            $form->handleRequest($globals);
            
            if ($form->isSubmitted() && $form->isValid())
             {
                 $debut = $commande->getDateArrivee();
                 $fin = $commande->getDateDepart();
                 $interval = $debut->diff($fin);
                 $days = $interval->days;    
                $commande->setDateEnregistrement(new \DateTime);
                $prix = $chambre->getPrixJournalier();
                $prix = $prix * $days;
                $commande->setPrixTotal($prix);
                $commande->setChambre($chambre);
                $manager->persist($commande);
                $manager->flush();
                $this->addFlash('success', 'La commande a bien été passée !');
            return $this->redirectToRoute('app_hostel');
        }
        return $this->renderForm("show/chambre.html.twig", [
           
            "chambre" => $chambre,
            'form' => $form,
        ]);
    }

    // #[Route('/contact',name:'contact')]
    // #[Route('/qui-sommes-nous?', name:'Qui?')]
    // public function qui(Request $globals, $contact = null){
    //     $form = $this->createForm(ContactType::class);
    //     $form->handleRequest($globals);
    //     if($form->isSubmitted() && $form->isValid())
    //     {
    //         $this->addFlash
    //     }
    // }

}
