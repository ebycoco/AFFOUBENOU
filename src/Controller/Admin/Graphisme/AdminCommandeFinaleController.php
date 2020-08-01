<?php

namespace App\Controller\Admin\Graphisme;

use App\Entity\CommandeLogo;
use App\Entity\CommandeFinale;
use App\Form\CommandeFinaleType;
use App\Repository\CommandeFinaleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/commande/finale", name="admin_")
 */
class AdminCommandeFinaleController extends AbstractController
{
    /**
     * @Route("/", name="commande_finale_index", methods={"GET"})
     */
    public function index(CommandeFinaleRepository $commandeFinaleRepository): Response
    {
        return $this->render('commande_finale/index.html.twig', [
            'commande_finales' => $commandeFinaleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajouter/finale/{id}", name="commande_finale_new", methods={"GET","POST"})
     */
    public function new(Request $request,CommandeLogo $commandeLogo): Response
    {
        $commandeFinale = new CommandeFinale();
        $form = $this->createForm(CommandeFinaleType::class, $commandeFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commandeFinale->setUser($this->getUser());
            $commandeFinale->setCommandelogo($commandeLogo); 
            $entityManager->persist($commandeFinale); 
            $commandeLogo->setEtat('1');
            $entityManager->flush();

            return $this->redirectToRoute('admin_commande_logo_index');
        }

        return $this->render('commande_finale/new.html.twig', [
            'commandeLogo' => $commandeLogo,
            'commande_finale' => $commandeFinale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/finale/{id}", name="commande_finale_show", methods={"GET"})
     */
    public function show(CommandeFinale $commandeFinale): Response
    {
        
        return $this->render('commande_finale/show.html.twig', [
            'commande_finale' => $commandeFinale, 
            
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_finale_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommandeFinale $commandeFinale,CommandeLogo $commandeLogo): Response
    {
        $form = $this->createForm(CommandeFinaleType::class, $commandeFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager(); 
            $commandeLogo->setEtat('1');
            $entityManager->flush();

            return $this->redirectToRoute('admin_commande_logo_index');
        }

        return $this->render('commande_finale/edit.html.twig', [
            'commande_finale' => $commandeFinale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_finale_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommandeFinale $commandeFinale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeFinale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandeFinale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_commande_logo_index');
    }
}
