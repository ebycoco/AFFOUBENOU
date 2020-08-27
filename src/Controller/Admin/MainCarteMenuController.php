<?php

namespace App\Controller\Admin;

use App\Entity\MainCarteMenu;
use App\Form\MainCarteMenuType;
use App\Repository\MainCarteMenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/main/carte/menu", name="admin_")
 */
class MainCarteMenuController extends AbstractController
{
    /**
     * @Route("/", name="main_carte_menu_index", methods={"GET"})
     */
    public function index(MainCarteMenuRepository $mainCarteMenuRepository): Response
    {
        return $this->render('Admin/main_carte_menu/index.html.twig', [
            'main_carte_menus' => $mainCarteMenuRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="main_carte_menu_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mainCarteMenu = new MainCarteMenu();
        $form = $this->createForm(MainCarteMenuType::class, $mainCarteMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mainCarteMenu->setUser($this->getUser());
            $entityManager->persist($mainCarteMenu);
            $entityManager->flush();

            return $this->redirectToRoute('admin_main_carte_menu_index');
        }

        return $this->render('Admin/main_carte_menu/new.html.twig', [
            'main_carte_menu' => $mainCarteMenu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_carte_menu_show", methods={"GET"})
     */
    public function show(MainCarteMenu $mainCarteMenu): Response
    {
        return $this->render('Admin/main_carte_menu/show.html.twig', [
            'main_carte_menu' => $mainCarteMenu,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="main_carte_menu_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MainCarteMenu $mainCarteMenu): Response
    {
        $form = $this->createForm(MainCarteMenuType::class, $mainCarteMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_main_carte_menu_index');
        }

        return $this->render('Admin/main_carte_menu/edit.html.twig', [
            'main_carte_menu' => $mainCarteMenu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_carte_menu_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MainCarteMenu $mainCarteMenu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainCarteMenu->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mainCarteMenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_main_carte_menu_index');
    }
}
