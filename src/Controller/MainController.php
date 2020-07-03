<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\SlidersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(SlidersRepository $slidersRepository,ArticlesRepository $articlesRepository)
    {
        return $this->render('main/index.html.twig', [ 
            'sliders' => $slidersRepository->findAll(), 
            'articles' => $articlesRepository->findAll(), 
        ]);
    }
}
