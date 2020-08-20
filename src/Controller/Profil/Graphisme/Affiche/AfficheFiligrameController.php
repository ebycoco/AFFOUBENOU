<?php

namespace App\Controller\Profil\Graphisme\Affiche;

use App\Entity\Affiche;
use App\Entity\AfficheFiligrame;
use App\Form\AfficheFiligrameType;
use App\Repository\AfficheFinaleRepository;
use App\Repository\CarteMenuFinaleRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AfficheFiligrameRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/profile/affiche/filigrame", name="profile_")
 */
class AfficheFiligrameController extends AbstractController
{ 

    /**
     * @Route("/{id}", name="affiche_filigrame_show", methods={"GET"})
     */
    public function show(Affiche $affiche): Response
    {
        return $this->render('profil/graphisme/affiche/filigramme.html.twig', [
            'affiche' => $affiche,
        ]);
    } 
 
}
