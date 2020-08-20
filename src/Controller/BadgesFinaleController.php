<?php

namespace App\Controller;

use App\Entity\BadgesFinale;
use App\Form\BadgesFinaleType;
use App\Repository\BadgesFinaleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/badges/finale")
 */
class BadgesFinaleController extends AbstractController
{
    /**
     * @Route("/", name="badges_finale_index", methods={"GET"})
     */
    public function index(BadgesFinaleRepository $badgesFinaleRepository): Response
    {
        return $this->render('badges_finale/index.html.twig', [
            'badges_finales' => $badgesFinaleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="badges_finale_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $badgesFinale = new BadgesFinale();
        $form = $this->createForm(BadgesFinaleType::class, $badgesFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($badgesFinale);
            $entityManager->flush();

            return $this->redirectToRoute('badges_finale_index');
        }

        return $this->render('badges_finale/new.html.twig', [
            'badges_finale' => $badgesFinale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badges_finale_show", methods={"GET"})
     */
    public function show(BadgesFinale $badgesFinale): Response
    {
        return $this->render('badges_finale/show.html.twig', [
            'badges_finale' => $badgesFinale,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="badges_finale_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BadgesFinale $badgesFinale): Response
    {
        $form = $this->createForm(BadgesFinaleType::class, $badgesFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('badges_finale_index');
        }

        return $this->render('badges_finale/edit.html.twig', [
            'badges_finale' => $badgesFinale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badges_finale_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BadgesFinale $badgesFinale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$badgesFinale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($badgesFinale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('badges_finale_index');
    }
}
