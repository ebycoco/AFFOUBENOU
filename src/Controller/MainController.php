<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\MainCarteMenu;
use App\Form\ContactType;
use App\Repository\ArticlesRepository;
use App\Repository\AvantageDuSiteRepository;
use App\Repository\CategorieRepository;
use App\Repository\EquipesRepository;
use App\Repository\IdentiteDuSiteRepository;
use App\Repository\ImageSloganRepository;
use App\Repository\ServicesRepository;
use App\Repository\GraphismeRepository;
use App\Repository\MainAfficheRepository;
use App\Repository\MainBadgeRepository;
use App\Repository\MainCarteMenuRepository;
use App\Repository\MainCarteVisiteRepository;
use App\Repository\MainLogoRepository;
use App\Repository\MainTemplateSiteRepository;
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
    public function index( ArticlesRepository $articlesRepository  , Request $request, IdentiteDuSiteRepository$identiteDuSiteRepository, AvantageDuSiteRepository $avantageDuSiteRepository, CategorieRepository $categorieRepository,MainBadgeRepository $mainBadgeRepository,MainCarteMenuRepository $mainCarteMenuRepository,MainAfficheRepository $mainAfficheRepository,MainCarteVisiteRepository $mainCarteVisiteRepository,MainLogoRepository $mainLogoRepository,MainTemplateSiteRepository $mainTemplateSiteRepository)
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
            'articles' => $articlesRepository->findBy(['active'=>true],['createdAt'=>'desc'],3), 
            'identite_du_sites' => $identiteDuSiteRepository->findBylast(),
            'avantage_du_sites' => $avantageDuSiteRepository->findByLast(),
            'categories' => $categorieRepository->findAll(),
            'badges' => $mainBadgeRepository->findOne(),
            'affiches' => $mainAfficheRepository->findOne(),
            'carte_menus' => $mainCarteMenuRepository->findOne(),
            'carte_vistes' => $mainCarteVisiteRepository->findOne(),
            'logos' => $mainLogoRepository->findOne(),
            'templates' => $mainTemplateSiteRepository->findOne(),
            'contact' => $contact,
            'form' => $form->createView(), 
        ]);
    }
}
