<?php

namespace App\Controller;

use App\Entity\Badges;
use App\Form\BadgesType;
use App\Repository\BadgesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/badges")
 */
class BadgesController extends AbstractController
{
    /**
     * @Route("/", name="badges_index", methods={"GET"})
     */
    public function index(BadgesRepository $badgesRepository): Response
    {
        return $this->render('badges/index.html.twig', [
            'badges' => $badgesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="badges_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $badge = new Badges();
        $form = $this->createForm(BadgesType::class, $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($badge);
            $entityManager->flush();

            return $this->redirectToRoute('badges_index');
        }

        return $this->render('badges/new.html.twig', [
            'badge' => $badge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badges_show", methods={"GET"})
     */
    public function show(Badges $badge): Response
    {
        return $this->render('badges/show.html.twig', [
            'badge' => $badge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="badges_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Badges $badge): Response
    {
        $form = $this->createForm(BadgesType::class, $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('badges_index');
        }

        return $this->render('badges/edit.html.twig', [
            'badge' => $badge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badges_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Badges $badge): Response
    {
        if ($this->isCsrfTokenValid('delete'.$badge->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($badge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('badges_index');
    }
}
