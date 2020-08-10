<?php

namespace App\Controller\Admin\Graphisme\Affiche;

use App\Entity\Affiche;
use App\Entity\CarteVisite;
use App\Repository\AfficheFinaleRepository;
use App\Repository\AfficheRepository;
use App\Repository\CarteVisiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarteVisiteFiligrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/commande/affiche", name="admin_")
 */

class AdminAfficheCommandeController extends AbstractController
{
    /**
     * @Route("/", name="affiche_index", methods={"GET"})
     */
    public function index(AfficheRepository $afficheRepository,AfficheFinaleRepository $afficheFinaleRepository): Response
    {
        return $this->render('Admin/admin_graphisme/affiche/index.html.twig', [
            'affiches' => $afficheRepository->findAll(),
            'affichesfinale' => $afficheFinaleRepository->findAll(),
        ]);
    }
    /**
     * @Route("/{id}", name="affiche_show", methods={"GET"})
     */
    public function show(Affiche $affiche): Response
    {
        return $this->render('Admin/admin_graphisme/affiche/show.html.twig', [
            'affiche' => $affiche,
        ]);
    }
}