<?php

namespace App\Controller;

use App\Repository\AvantageDuSiteRepository;
use App\Repository\IdentiteDuSiteRepository;
use App\Repository\TemoignagesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AproposController extends AbstractController
{
    /**
     * @Route("/apropos", name="app_apropos")
     */
    public function index(IdentiteDuSiteRepository $identiteDuSiteRepository,AvantageDuSiteRepository $avantageDuSiteRepository,TemoignagesRepository $temoignagesRepository)
    {
        return $this->render('apropos/index.html.twig', [
            'controller_name' => 'AproposController',
            'identite_du_sites' => $identiteDuSiteRepository->findAll(), 
            'avantage_du_sites' => $avantageDuSiteRepository->findAll(),
            'temoignages' => $temoignagesRepository->findAll(),

        ]);
    }
}
