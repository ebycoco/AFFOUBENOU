<?php

namespace App\Controller\Admin\Graphisme\Badge;

use App\Entity\Badges; 
use App\Repository\BadgesFinaleRepository;
use App\Repository\BadgesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/commande/badge", name="admin_")
 */

class AdminBadgeCommandeController extends AbstractController
{
    /**
     * @Route("/", name="badge_index", methods={"GET"})
     */
    public function index(BadgesRepository $badgesRepository,BadgesFinaleRepository $badgesFinaleRepository ): Response
    {
        return $this->render('Admin/admin_graphisme/badge/index.html.twig', [
            'badges' => $badgesRepository->findAll(),
            'badgesfinales' => $badgesFinaleRepository->findAll(),
        ]);
    }
    /**
     * @Route("/{id}", name="badge_show", methods={"GET"})
     */
    public function show(Badges $badge): Response
    {
        return $this->render('Admin/admin_graphisme/badge/show.html.twig', [
            'badge' => $badge,
        ]);
    }
}