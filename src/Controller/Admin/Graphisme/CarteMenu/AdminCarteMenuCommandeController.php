<?php

namespace App\Controller\Admin\Graphisme\CarteMenu;
 
use App\Entity\CarteMenu;
use App\Repository\CarteMenuFinaleRepository;
use App\Repository\CarteMenuRepository;  
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/commande/carte-menu", name="admin_")
 */

class AdminCarteMenuCommandeController extends AbstractController
{
    /**
     * @Route("/", name="carte_menu_index", methods={"GET"})
     */
    public function index(CarteMenuRepository $carteMenuRepository,CarteMenuFinaleRepository $carteMenuFinaleRepository): Response
    {
        return $this->render('Admin/admin_graphisme/carte_menu/index.html.twig', [
            'CarteMenus' => $carteMenuRepository->findAll(), 
            'CarteMenufinales' => $carteMenuFinaleRepository->findAll(),
        ]);
    }
    /**
     * @Route("/{id}", name="carte_menu_show", methods={"GET"})
     */
    public function show(CarteMenu $carteMenu): Response
    {
        return $this->render('Admin/admin_graphisme/carte_menu/show.html.twig', [
            'carte_menu' => $carteMenu,
        ]);
    }
}