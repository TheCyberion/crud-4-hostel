<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use App\Repository\ChambreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HostelController extends AbstractController
{
    #[Route('/', name: 'app_hostel')]
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
        $chambres = $repo->FindAll();
        return $this->render('hostel/chambres.html.twig', [
            'chambres'=>$chambres
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
}
