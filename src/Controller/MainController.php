<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ArticlesRepository;
use App\Repository\EquipesRepository;
use App\Repository\IdentiteDuSiteRepository;
use App\Repository\ImageSloganRepository;
use App\Repository\ServicesRepository;
use App\Repository\GraphismeRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\SlidersRepository;
use App\Repository\SloganRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(SlidersRepository $slidersRepository,ArticlesRepository $articlesRepository,EquipesRepository $equipesRepository, GraphismeRepository $graphismeRepository,ImageSloganRepository $imageSloganRepository,SloganRepository $sloganRepository, Request $request, IdentiteDuSiteRepository $identiteDuSiteRepository)
    {
        // return $this->render('main/index.html.twig', [ 
        //     'sliders' => $slidersRepository->findBySlid(), 
        //     'serviceGraphs' => $graphismeRepository->findByGraphisme(),
        //     'equipes' => $equipesRepository->findAll(), 
        //     'articles' => $articlesRepository->findBy(['active'=>true],['createdAt'=>'desc'],3), 
        //     'slogans' => $sloganRepository->findBySlogan(), 
        //     'imageslogans' => $imageSloganRepository->findByImagSlog(), 
        // ]);

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('main/main.html.twig', [ 
            'sliders' => $slidersRepository->findBySlid(), 
            'serviceGraphs' => $graphismeRepository->findByGraphisme(),
            'equipes' => $equipesRepository->findAll(), 
            'articles' => $articlesRepository->findBy(['active'=>true],['createdAt'=>'desc'],3), 
            'slogans' => $sloganRepository->findBySlogan(), 
            'imageslogans' => $imageSloganRepository->findByImagSlog(),
            'identite_du_sites' => $identiteDuSiteRepository->findBylast(),
            'contact' => $contact,
            'form' => $form->createView(), 
        ]);
    }
}
