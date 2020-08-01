<?php

namespace App\Controller\Admin\Graphisme;

use App\Entity\CommandeLogo;
use App\Entity\CommandePredefine;
use App\Form\CommandePredefineType;
use App\Repository\CommandePredefineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/commande/predefinie", name="admin_")
 */
class AdminCommandePredefineController extends AbstractController
{
    /**
     * @Route("/", name="commande_predefine_index", methods={"GET"})
     */
    public function index(CommandePredefineRepository $commandePredefineRepository): Response
    {
        return $this->render('commande_predefine/index.html.twig', [
            'commande_predefines' => $commandePredefineRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajouter/filigrame/{id}", name="commande_predefine_new", methods={"GET","POST"})
     */
    public function new(Request $request,CommandeLogo $commandeLogo): Response
    {
        $commandePredefine = new CommandePredefine();
        $form = $this->createForm(CommandePredefineType::class, $commandePredefine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commandePredefine->setUser($this->getUser());
            $commandePredefine->setCommandelogo($commandeLogo); 
            $entityManager->persist($commandePredefine); 
            $commandeLogo->setPredefinie($commandePredefine);
            $commandeLogo->setEtat('0');
            $entityManager->flush();

            return $this->redirectToRoute('admin_commande_logo_index');
        }

        return $this->render('commande_predefine/new.html.twig', [
            'commande_predefine' => $commandePredefine,
            'commandeLogo' => $commandeLogo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_predefine_show", methods={"GET"})
     */
    public function show(CommandePredefine $commandePredefine): Response
    {  
        return $this->render('commande_predefine/show.html.twig', [
            'commande_predefine' => $commandePredefine,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_predefine_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommandePredefine $commandePredefine,CommandeLogo $commandeLogo): Response
    {
        $form = $this->createForm(CommandePredefineType::class, $commandePredefine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commandeLogo->setEtat('0');
            $entityManager->flush();

            return $this->redirectToRoute('commande_predefine_index');
        }

        return $this->render('commande_predefine/edit.html.twig', [
            'commande_predefine' => $commandePredefine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_predefine_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommandePredefine $commandePredefine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandePredefine->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandePredefine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_predefine_index');
    }
}
