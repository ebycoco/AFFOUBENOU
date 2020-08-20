<?php

namespace App\Controller\Profil\Graphisme\CarteMenu;

use App\Entity\CarteMenu;
use App\Entity\CarteMenuFiligramme;
use App\Form\CarteMenuFiligrammeType;
use App\Repository\CarteMenuFiligrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile/carte-menu/filigramme", name="profile_")
 */
class CarteMenuFiligrammeController extends AbstractController
{   

    /**
     * @Route("/filigramme/{id}", name="carte_menu_filigramme_show", methods={"GET"})
     */
    public function show(CarteMenu $carteMenu): Response
    {
        return $this->render('profil/graphisme/carte_menu/filigramme.html.twig', [
            'carteMenu' => $carteMenu,
        ]);
    }  
}
