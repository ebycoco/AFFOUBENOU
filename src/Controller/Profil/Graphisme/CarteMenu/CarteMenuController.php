<?php

namespace App\Controller\Profil\Graphisme\CarteMenu;

use App\Entity\CarteMenu;
use App\Form\CarteMenuType;
use App\Repository\CarteMenuRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile/carte-menu", name="profile_")
 */
class CarteMenuController extends AbstractController
{
    /**
     * @Route("/", name="carte_menu_index", methods={"GET"})
     */
    public function index(CarteMenuRepository $carteMenuRepository): Response
    {
        return $this->render('profil/graphisme/carte_menu/index.html.twig', [
            'carte_menus' => $carteMenuRepository->findAll(),
        ]);
    }

     /* Debut les Carte menus de la partie profile */

    /**
     * Elle permet de lister les  Carte menus simple dans la partie commande du profile
     *  
     * @Route("/commande", name="commande_carte_menu", methods={"GET"})
     */
    public function commandeCartemenu(CarteMenuRepository $carteMenuRepository, PaginatorInterface $paginator,Request $request): Response
    {
        $carteMenu = $paginator->paginate(
            $carteMenuRepository->findAllVisibleQuery($this->getUser()),
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('profil/commandecartemenu.html.twig',[ 
            'carteMenus' => $carteMenu,
        ]);
    } 

    /**
     * @Route("/new", name="carte_menu_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carteMenu = new CarteMenu();
        $form = $this->createForm(CarteMenuType::class, $carteMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $carteMenu->setUser($this->getUser());
            $carteMenu->setEtat('niveau 1');
            $carteMenu->setPrix('2000');
            $entityManager->persist($carteMenu);
            $entityManager->flush();

            $this->addFlash('success', 'Votre achat à été effectuer avec success');
            return $this->redirectToRoute('profile_commande_carte_menu');
        }

        return $this->render('profil/graphisme/carte_menu/new.html.twig', [
            'carte_menu' => $carteMenu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_menu_show", methods={"GET"})
     */
    public function show(CarteMenu $carteMenu): Response
    {
        return $this->render('profil/graphisme/carte_menu/show.html.twig', [
            'carte_menu' => $carteMenu,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carte_menu_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CarteMenu $carteMenu): Response
    {
        $form = $this->createForm(CarteMenuType::class, $carteMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carte_menu_index');
        }

        return $this->render('profil/graphisme/carte_menu/edit.html.twig', [
            'carte_menu' => $carteMenu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_menu_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CarteMenu $carteMenu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carteMenu->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carteMenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carte_menu_index');
    }
}
