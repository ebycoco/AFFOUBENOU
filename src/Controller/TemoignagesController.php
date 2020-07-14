<?php

namespace App\Controller;

use App\Entity\Temoignages;
use App\Form\TemoignagesType;
use App\Repository\TemoignagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/temoignages")
 */
class TemoignagesController extends AbstractController
{
    /**
     * @Route("/", name="temoignages_index", methods={"GET"})
     */
    public function index(TemoignagesRepository $temoignagesRepository): Response
    {
        return $this->render('temoignages/index.html.twig', [
            'temoignages' => $temoignagesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="temoignages_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $temoignage = new Temoignages();
        $form = $this->createForm(TemoignagesType::class, $temoignage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($temoignage);
            $entityManager->flush();

            return $this->redirectToRoute('temoignages_index');
        }

        return $this->render('temoignages/new.html.twig', [
            'temoignage' => $temoignage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="temoignages_show", methods={"GET"})
     */
    public function show(Temoignages $temoignage): Response
    {
        return $this->render('temoignages/show.html.twig', [
            'temoignage' => $temoignage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="temoignages_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Temoignages $temoignage): Response
    {
        $form = $this->createForm(TemoignagesType::class, $temoignage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('temoignages_index');
        }

        return $this->render('temoignages/edit.html.twig', [
            'temoignage' => $temoignage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="temoignages_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Temoignages $temoignage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$temoignage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($temoignage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('temoignages_index');
    }
}
