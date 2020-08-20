<?php

namespace App\Controller;

use App\Entity\BadgesFiligramme;
use App\Form\BadgesFiligrammeType;
use App\Repository\BadgesFiligrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/badges/filigramme")
 */
class BadgesFiligrammeController extends AbstractController
{
    /**
     * @Route("/", name="badges_filigramme_index", methods={"GET"})
     */
    public function index(BadgesFiligrammeRepository $badgesFiligrammeRepository): Response
    {
        return $this->render('badges_filigramme/index.html.twig', [
            'badges_filigrammes' => $badgesFiligrammeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="badges_filigramme_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $badgesFiligramme = new BadgesFiligramme();
        $form = $this->createForm(BadgesFiligrammeType::class, $badgesFiligramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($badgesFiligramme);
            $entityManager->flush();

            return $this->redirectToRoute('badges_filigramme_index');
        }

        return $this->render('badges_filigramme/new.html.twig', [
            'badges_filigramme' => $badgesFiligramme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badges_filigramme_show", methods={"GET"})
     */
    public function show(BadgesFiligramme $badgesFiligramme): Response
    {
        return $this->render('badges_filigramme/show.html.twig', [
            'badges_filigramme' => $badgesFiligramme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="badges_filigramme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BadgesFiligramme $badgesFiligramme): Response
    {
        $form = $this->createForm(BadgesFiligrammeType::class, $badgesFiligramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('badges_filigramme_index');
        }

        return $this->render('badges_filigramme/edit.html.twig', [
            'badges_filigramme' => $badgesFiligramme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badges_filigramme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BadgesFiligramme $badgesFiligramme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$badgesFiligramme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($badgesFiligramme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('badges_filigramme_index');
    }
}
