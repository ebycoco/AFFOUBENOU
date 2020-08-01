<?php

namespace App\Controller;

use App\Entity\CommandeLogoPersonalise;
use App\Form\CommandeLogoPersonaliseType;
use App\Repository\CommandeLogoPersonaliseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commande/logo/personalise")
 */
class CommandeLogoPersonaliseController extends AbstractController
{
    /**
     * @Route("/", name="commande_logo_personalise_index", methods={"GET"})
     */
    public function index(CommandeLogoPersonaliseRepository $commandeLogoPersonaliseRepository): Response
    {
        return $this->render('commande_logo_personalise/index.html.twig', [
            'commande_logo_personalises' => $commandeLogoPersonaliseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commande_logo_personalise_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commandeLogoPersonalise = new CommandeLogoPersonalise();
        $form = $this->createForm(CommandeLogoPersonaliseType::class, $commandeLogoPersonalise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commandeLogoPersonalise);
            $entityManager->flush();

            return $this->redirectToRoute('commande_logo_personalise_index');
        }

        return $this->render('commande_logo_personalise/new.html.twig', [
            'commande_logo_personalise' => $commandeLogoPersonalise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_logo_personalise_show", methods={"GET"})
     */
    public function show(CommandeLogoPersonalise $commandeLogoPersonalise): Response
    {
        return $this->render('commande_logo_personalise/show.html.twig', [
            'commande_logo_personalise' => $commandeLogoPersonalise,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_logo_personalise_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommandeLogoPersonalise $commandeLogoPersonalise): Response
    {
        $form = $this->createForm(CommandeLogoPersonaliseType::class, $commandeLogoPersonalise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_logo_personalise_index');
        }

        return $this->render('commande_logo_personalise/edit.html.twig', [
            'commande_logo_personalise' => $commandeLogoPersonalise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_logo_personalise_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommandeLogoPersonalise $commandeLogoPersonalise): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeLogoPersonalise->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandeLogoPersonalise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_logo_personalise_index');
    }
}
