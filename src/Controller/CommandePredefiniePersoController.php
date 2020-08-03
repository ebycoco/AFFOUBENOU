<?php

namespace App\Controller;

use App\Entity\CommandePredefiniePerso;
use App\Form\CommandePredefiniePersoType;
use App\Repository\CommandePredefiniePersoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commande/predefinie/perso")
 */
class CommandePredefiniePersoController extends AbstractController
{
    /**
     * @Route("/", name="commande_predefinie_perso_index", methods={"GET"})
     */
    public function index(CommandePredefiniePersoRepository $commandePredefiniePersoRepository): Response
    {
        return $this->render('commande_predefinie_perso/index.html.twig', [
            'commande_predefinie_persos' => $commandePredefiniePersoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commande_predefinie_perso_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commandePredefiniePerso = new CommandePredefiniePerso();
        $form = $this->createForm(CommandePredefiniePersoType::class, $commandePredefiniePerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commandePredefiniePerso);
            $entityManager->flush();

            return $this->redirectToRoute('commande_predefinie_perso_index');
        }

        return $this->render('commande_predefinie_perso/new.html.twig', [
            'commande_predefinie_perso' => $commandePredefiniePerso,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_predefinie_perso_show", methods={"GET"})
     */
    public function show(CommandePredefiniePerso $commandePredefiniePerso): Response
    {
        return $this->render('commande_predefinie_perso/show.html.twig', [
            'commande_predefinie_perso' => $commandePredefiniePerso,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_predefinie_perso_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommandePredefiniePerso $commandePredefiniePerso): Response
    {
        $form = $this->createForm(CommandePredefiniePersoType::class, $commandePredefiniePerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_predefinie_perso_index');
        }

        return $this->render('commande_predefinie_perso/edit.html.twig', [
            'commande_predefinie_perso' => $commandePredefiniePerso,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_predefinie_perso_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommandePredefiniePerso $commandePredefiniePerso): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandePredefiniePerso->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandePredefiniePerso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_predefinie_perso_index');
    }
}
