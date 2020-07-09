<?php

namespace App\Controller;

use App\Repository\GraphismeRepository; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServiceGraphismeController extends AbstractController
{
    /**
     * @Route("/service/graphisme", name="service_graphisme")
     */
    public function index(GraphismeRepository $graphismeRepository)
    {
        return $this->render('service_graphisme/index.html.twig', [
            'serviceGraphs' => $graphismeRepository->findAll(),
        ]);
    }
}
