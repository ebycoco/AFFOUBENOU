<?php

namespace App\Controller\Admin;

use App\Entity\MainCarteVisite;
use App\Form\MainCarteVisiteType;
use App\Repository\MainCarteVisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/main/carte/visite", name="admin_")
 */
class MainCarteVisiteController extends AbstractController
{
    /**
     * @Route("/", name="main_carte_visite_index", methods={"GET"})
     */
    public function index(MainCarteVisiteRepository $mainCarteVisiteRepository): Response
    {
        return $this->render('Admin/main_carte_visite/index.html.twig', [
            'main_carte_visites' => $mainCarteVisiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="main_carte_visite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mainCarteVisite = new MainCarteVisite();
        $form = $this->createForm(MainCarteVisiteType::class, $mainCarteVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mainCarteVisite->setUser($this->getUser());
            $entityManager->persist($mainCarteVisite);
            $entityManager->flush();

            return $this->redirectToRoute('admin_main_carte_visite_index');
        }

        return $this->render('Admin/main_carte_visite/new.html.twig', [
            'main_carte_visite' => $mainCarteVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_carte_visite_show", methods={"GET"})
     */
    public function show(MainCarteVisite $mainCarteVisite): Response
    {
        return $this->render('Admin/main_carte_visite/show.html.twig', [
            'main_carte_visite' => $mainCarteVisite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="main_carte_visite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MainCarteVisite $mainCarteVisite): Response
    {
        $form = $this->createForm(MainCarteVisiteType::class, $mainCarteVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_main_carte_visite_index');
        }

        return $this->render('Admin/main_carte_visite/edit.html.twig', [
            'main_carte_visite' => $mainCarteVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_carte_visite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MainCarteVisite $mainCarteVisite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainCarteVisite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mainCarteVisite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_main_carte_visite_index');
    }
}
