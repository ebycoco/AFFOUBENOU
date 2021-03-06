<?php

namespace App\Controller\Profil\Graphisme\Logo;

use App\Entity\Categorie;
use App\Repository\ServicesRepository;
use App\Repository\CategorieRepository; 
use App\Repository\ServicesGraphismeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *  @Route("/profile/graphisme", name="profile_")
 */

class ProfilServiceGraphismeController extends AbstractController
{
    /**
     * @Route("/", name="service_graphisme")
     */
    public function index(CategorieRepository $categorieRepository)
    {
        return $this->render('profil/graphisme/graphisme.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/choix/logo/{id}", name="service_graphisme_choix")
     */
    public function choix(ServicesGraphismeRepository $servicesLogoRepository,Categorie $categorie)
    { 
       
        return $this->render('profil/graphisme/logo/choix_logo.html.twig', [
            'categorie' => $categorie,
            'serviceLogos' => $servicesLogoRepository->findByGraph($categorie),
        ]);
    }

    /**
     * @Route("/logo/{id}", name="service_graphisme_logo")
     */
    public function logo(ServicesGraphismeRepository $servicesLogoRepository,Categorie $categorie)
    { 
       
        return $this->render('profil/graphisme/logo/services_logo.html.twig', [
            'categorie' => $categorie,
            'serviceLogos' => $servicesLogoRepository->findByGraph($categorie),
        ]);
    }
}
