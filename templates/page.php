<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServiceWebController extends AbstractController
{
    /**
     * @Route("/service/web", name="service_web")
     */
    public function index()
    {
        return $this->render('service_web/index.html.twig', [
            'controller_name' => 'ServiceWebController',
        ]);
    }
}
