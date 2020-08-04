<?php

namespace App\Controller\Admin\Graphisme\CarteViste;
use App\Entity\CarteVisite; 
use App\Repository\CarteVisiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarteVisiteFiligrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/commande/carte/visite", name="admin_")
 */

class AdminCarteVisiteCommandeController extends AbstractController
{
    /**
     * @Route("/", name="carte_visite_index", methods={"GET"})
     */
    public function index(CarteVisiteRepository $carteVisiteRepository): Response
    {
        return $this->render('Admin/admin_graphisme/carte_visite/index.html.twig', [
            'carte_visites' => $carteVisiteRepository->findAll(),
        ]);
    }
    /**
     * @Route("/{id}", name="carte_visite_show", methods={"GET"})
     */
    public function show(CarteVisite $carteVisite): Response
    {
        return $this->render('Admin/admin_graphisme/carte_visite/show.html.twig', [
            'carte_visite' => $carteVisite,
        ]);
    }
}