<?php

namespace App\Controller\Admin\Web;

use App\Repository\CommandeServicesWebRepository;
use App\Repository\ServiceWebDemoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/commande/site", name="admin_")
 */

class AdminSiteWebController extends AbstractController
{
    /**
     * @Route("/", name="site_index", methods={"GET"})
     */
    public function index(CommandeServicesWebRepository $commandeServicesWebRepository,ServiceWebDemoRepository $serviceWebDemoRepository): Response
    {
        return $this->render('Admin/admin_siteWeb/index.html.twig', [
            'sites' => $commandeServicesWebRepository->findAll(),
            'siteDemos' => $serviceWebDemoRepository->findAll(),
        ]);
    }
}