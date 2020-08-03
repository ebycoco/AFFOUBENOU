<?php

namespace App\Controller;

use App\Entity\CommandeFinalePerso;
use App\Form\CommandeFinalePersoType;
use App\Repository\CommandeFinalePersoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commande/finale/perso")
 */
class CommandeFinalePersoController extends AbstractController
{
    /**
     * @Route("/", name="commande_finale_perso_index", methods={"GET"})
     */
    public function index(CommandeFinalePersoRepository $commandeFinalePersoRepository): Response
    {
        return $this->render('commande_finale_perso/index.html.twig', [
            'commande_finale_persos' => $commandeFinalePersoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commande_finale_perso_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commandeFinalePerso = new CommandeFinalePerso();
        $form = $this->createForm(CommandeFinalePersoType::class, $commandeFinalePerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commandeFinalePerso);
            $entityManager->flush();

            return $this->redirectToRoute('commande_finale_perso_index');
        }

        return $this->render('commande_finale_perso/new.html.twig', [
            'commande_finale_perso' => $commandeFinalePerso,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_finale_perso_show", methods={"GET"})
     */
    public function show(CommandeFinalePerso $commandeFinalePerso): Response
    {
        return $this->render('commande_finale_perso/show.html.twig', [
            'commande_finale_perso' => $commandeFinalePerso,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_finale_perso_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommandeFinalePerso $commandeFinalePerso): Response
    {
        $form = $this->createForm(CommandeFinalePersoType::class, $commandeFinalePerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_finale_perso_index');
        }

        return $this->render('commande_finale_perso/edit.html.twig', [
            'commande_finale_perso' => $commandeFinalePerso,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_finale_perso_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommandeFinalePerso $commandeFinalePerso): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeFinalePerso->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandeFinalePerso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_finale_perso_index');
    }
}
