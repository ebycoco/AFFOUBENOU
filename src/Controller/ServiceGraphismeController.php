<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\GraphismeRepository; 
use App\Repository\CategorieRepository;
use App\Repository\ServicesGraphismeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServiceGraphismeController extends AbstractController
{
    /**
     * @Route("/service/graphisme", name="service_graphisme")
     */
    public function index(CategorieRepository $categorieRepository)
    {
        return $this->render('service_graphisme/graphisme.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/service/graphisme/logo/{id}", name="service_graphisme_logo")
     */
    public function logo(ServicesGraphismeRepository $servicesGraphismeRepository,Categorie $categorie)
    { 
       
        return $this->render('service_graphisme/services_graphisme.html.twig', [
            'categorie' => $categorie,
            'serviceGraphs' => $servicesGraphismeRepository->findByGraph($categorie),
        ]);
    }
}
