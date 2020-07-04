<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\EquipesRepository;
use App\Repository\ServicesRepository;
use App\Repository\SlidersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(SlidersRepository $slidersRepository,ArticlesRepository $articlesRepository,EquipesRepository $equipesRepository, ServicesRepository $servicesRepository)
    {
        return $this->render('main/index.html.twig', [ 
            'sliders' => $slidersRepository->findAll(), 
            'services' => $servicesRepository->findAll(), 
            'equipes' => $equipesRepository->findAll(), 
            'articles' => $articlesRepository->findAll(), 
        ]);
    }
}
