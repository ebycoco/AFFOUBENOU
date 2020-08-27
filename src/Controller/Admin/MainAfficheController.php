<?php

namespace App\Controller\Admin;

use App\Entity\MainAffiche;
use App\Form\MainAfficheType;
use App\Repository\MainAfficheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/main/affiche", name="admin_")
 */
class MainAfficheController extends AbstractController
{
    /**
     * @Route("/", name="main_affiche_index", methods={"GET"})
     */
    public function index(MainAfficheRepository $mainAfficheRepository): Response
    {
        return $this->render('Admin/main_affiche/index.html.twig', [
            'main_affiches' => $mainAfficheRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="main_affiche_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mainAffiche = new MainAffiche();
        $form = $this->createForm(MainAfficheType::class, $mainAffiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mainAffiche->setUser($this->getUser());
            $entityManager->persist($mainAffiche);
            $entityManager->flush();

            return $this->redirectToRoute('admin_main_affiche_index');
        }

        return $this->render('Admin/main_affiche/new.html.twig', [
            'main_affiche' => $mainAffiche,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_affiche_show", methods={"GET"})
     */
    public function show(MainAffiche $mainAffiche): Response
    {
        return $this->render('Admin/main_affiche/show.html.twig', [
            'main_affiche' => $mainAffiche,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="main_affiche_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MainAffiche $mainAffiche): Response
    {
        $form = $this->createForm(MainAfficheType::class, $mainAffiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_main_affiche_index');
        }

        return $this->render('Admin/main_affiche/edit.html.twig', [
            'main_affiche' => $mainAffiche,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_affiche_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MainAffiche $mainAffiche): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainAffiche->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mainAffiche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_main_affiche_index');
    }
}
