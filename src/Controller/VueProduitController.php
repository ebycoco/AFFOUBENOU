<?php

namespace App\Controller;

use App\Entity\CommandeLogo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VueProduitController extends AbstractController
{
    /**
     * @Route("/vue/produit/{id}", name="vue_produit")
     */
    public function index(CommandeLogo $commandeLogo)
    {
        return $this->render('vue_produit/vueproduit.html.twig', [
            'commandeLogo' => $commandeLogo,
        ]);
    }
}
