<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VueProduitController extends AbstractController
{
    /**
     * @Route("/vue/produit", name="vue_produit")
     */
    public function index()
    {
        return $this->render('vue_produit/vueproduit.html.twig', [
            'controller_name' => 'VueProduitController',
        ]);
    }
}
