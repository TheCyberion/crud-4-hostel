<?php


namespace App\Controller\Admin;

use App\Entity\Commentaire;
 use App\Entity\Membre;
 use App\Entity\Slider;
 use App\Entity\Chambre;
 use App\Entity\Commande;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;
 use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
 use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
 use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
 use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

 class DashboardController extends AbstractDashboardController
 {
    
     private $routeBuilder;
     public function __construct(AdminUrlGenerator $routeBuilder)
     {
     $this->routeBuilder = $routeBuilder; 
     }

     /**
      * @Route("/admin", name="admin")
      */
     public function index(): Response
     {
         return parent::index();
     }

     public function configureDashboard(): Dashboard
     {
         return Dashboard::new()
            ->setTitle('BACKOFFICE Hostel');
     }

     public function configureMenuItems(): iterable
     {
         return[
           
             MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
             MenuItem::section('Retour accueil'),
             MenuItem::linkToRoute("Accueil", 'fas fa-arrow-left', 'app_hostel'),
             MenuItem::section('Commandes'),
             MenuItem::linkToCrud('Commandes', 'fas fa-hotel', Commande::class),
              MenuItem::section('Membres'),
              MenuItem::linkToCrud('Membres', 'fas fa-user', Membre::class),
             MenuItem::section("Chambre"),
             MenuItem::linkToCrud('Chambre', 'fas fa-bed', Chambre::class),
             MenuItem::section('Slider'),
             MenuItem::linktocrud('Slider', 'fas fa-images', Slider::class),
             MenuItem::linkToCrud('Commentaires', 'fas fa-book', Commentaire::class)
         ];            
     }
 }
