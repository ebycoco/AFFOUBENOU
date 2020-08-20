<?php

namespace App\Controller\Profil\Graphisme\Badge;

use App\Entity\Badges;
use App\Entity\BadgesFiligramme;
use App\Form\BadgesFiligrammeType;
use App\Repository\BadgesFiligrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile/badge-filigramme", name="profile_")
 */
class BadgesFiligrammeController extends AbstractController
{   

    /**
     * @Route("/{id}", name="badges_filigramme_show", methods={"GET"})
     */
    public function show(Badges $badge): Response
    {
        return $this->render('profil/graphisme/badges/filigramme.html.twig', [
            'badge' => $badge,
        ]);
    }

     
}
