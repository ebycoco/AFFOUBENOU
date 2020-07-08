<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    
    public function index()
    {
        return $this->render('Admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
