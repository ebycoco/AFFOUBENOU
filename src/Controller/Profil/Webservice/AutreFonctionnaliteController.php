<?php

namespace App\Controller\Profil\Webservice;

use App\Entity\AutreFonctionnalite;
use App\Form\AutreFonctionnaliteType;
use App\Repository\AutreFonctionnaliteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile/autre_fonctionnalite",name="profile_")
 */
class AutreFonctionnaliteController extends AbstractController
{
    /**
     * @Route("/", name="autre_fonctionnalite_index", methods={"GET"})
     */
    public function index(AutreFonctionnaliteRepository $autreFonctionnaliteRepository): Response
    {
        return $this->render('autre_fonctionnalite/index.html.twig', [
            'autre_fonctionnalites' => $autreFonctionnaliteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="autre_fonctionnalite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $autreFonctionnalite = new AutreFonctionnalite();
        $form = $this->createForm(AutreFonctionnaliteType::class, $autreFonctionnalite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $autreFonctionnalite->setUser($this->getUser());
            $entityManager->persist($autreFonctionnalite);
            $entityManager->flush();

            return $this->redirectToRoute('autre_fonctionnalite_index');
        }

        return $this->render('autre_fonctionnalite/new.html.twig', [
            'autre_fonctionnalite' => $autreFonctionnalite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="autre_fonctionnalite_show", methods={"GET"})
     */
    public function show(AutreFonctionnalite $autreFonctionnalite): Response
    {
        return $this->render('autre_fonctionnalite/show.html.twig', [
            'autre_fonctionnalite' => $autreFonctionnalite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="autre_fonctionnalite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AutreFonctionnalite $autreFonctionnalite): Response
    {
        $form = $this->createForm(AutreFonctionnaliteType::class, $autreFonctionnalite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('autre_fonctionnalite_index');
        }

        return $this->render('autre_fonctionnalite/edit.html.twig', [
            'autre_fonctionnalite' => $autreFonctionnalite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="autre_fonctionnalite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AutreFonctionnalite $autreFonctionnalite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$autreFonctionnalite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($autreFonctionnalite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('autre_fonctionnalite_index');
    }
}
