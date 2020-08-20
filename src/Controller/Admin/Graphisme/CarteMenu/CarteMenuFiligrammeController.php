<?php

namespace App\Controller\Admin\Graphisme\CarteMenu;

use App\Entity\CarteMenu;
use App\Entity\CarteMenuFiligramme;
use App\Form\CarteMenuFiligrammeType;
use App\Repository\CarteMenuFiligrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/carte-menu/filigramme",name="admin_")
 */
class CarteMenuFiligrammeController extends AbstractController
{
    /**
     * @Route("/", name="carte_menu_filigramme_index", methods={"GET"})
     */
    public function index(CarteMenuFiligrammeRepository $carteMenuFiligrammeRepository): Response
    {
        return $this->render('Admin/admin_graphisme/carte_menu/carte_menu_filigramme/index.html.twig', [
            'carte_menu_filigrammes' => $carteMenuFiligrammeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="carte_menu_filigramme_new", methods={"GET","POST"})
     */
    public function new(Request $request,CarteMenu $carteMenu): Response
    {
        $carteMenuFiligramme = new CarteMenuFiligramme();
        $form = $this->createForm(CarteMenuFiligrammeType::class, $carteMenuFiligramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $carteMenuFiligramme->setUser($this->getUser());
            $carteMenuFiligramme->setCartemenu($carteMenu);
            $carteMenu->setEtat('niveau 2');
            $carteMenu->setPredefinie($carteMenuFiligramme);
            $entityManager->persist($carteMenuFiligramme);
            $entityManager->flush();

            return $this->redirectToRoute('admin_carte_menu_index');
        }

        return $this->render('Admin/admin_graphisme/carte_menu/carte_menu_filigramme/new.html.twig', [
            'carte_menu_filigramme' => $carteMenuFiligramme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/filigramme/{id}", name="carte_menu_filigramme_show", methods={"GET"})
     */
    public function show(CarteMenuFiligramme $carteMenuFiligramme): Response
    {
        return $this->render('Admin/admin_graphisme/carte_menu/carte_menu_filigramme/show.html.twig', [
            'carte_menu_filigramme' => $carteMenuFiligramme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carte_menu_filigramme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CarteMenuFiligramme $carteMenuFiligramme): Response
    {
        $form = $this->createForm(CarteMenuFiligrammeType::class, $carteMenuFiligramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carte_menu_filigramme_index');
        }

        return $this->render('Admin/admin_graphisme/carte_menu/carte_menu_filigramme/edit.html.twig', [
            'carte_menu_filigramme' => $carteMenuFiligramme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_menu_filigramme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CarteMenuFiligramme $carteMenuFiligramme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carteMenuFiligramme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carteMenuFiligramme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carte_menu_filigramme_index');
    }
}
