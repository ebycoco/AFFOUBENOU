<?php

namespace App\Controller\Admin\Graphisme;

use App\Entity\CommandeLogo;
use App\Entity\CommandePredefine;
use App\Form\CommandePredefineType; 
use App\Entity\CommandeFinale;
use App\Form\CommandeFinaleType;
use App\Repository\CommandeFinaleRepository;
use App\Repository\CommandePredefineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/commande/logo", name="admin_")
 */
class AdminCommandeLogoController extends AbstractController
{
    /**
     * @Route("/predefinie", name="commande_predefine_index", methods={"GET"})
     */
    public function predefinie(CommandePredefineRepository $commandePredefineRepository): Response
    {
        return $this->render('commande_predefine/index.html.twig', [
            'commande_predefines' => $commandePredefineRepository->findAll(),
        ]);
    }

    /**
     * @Route("/predefinie/ajouter/filigrame/{id}", name="commande_predefine_new", methods={"GET","POST"})
     */
    public function newfiligrame(Request $request,CommandeLogo $commandeLogo): Response
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
     * @Route("/predefinie/{id}", name="commande_predefine_show", methods={"GET"})
     */
    public function showfiligrame(CommandePredefine $commandePredefine): Response
    {  
        return $this->render('commande_predefine/show.html.twig', [
            'commande_predefine' => $commandePredefine,
        ]);
    }

    /**
     * @Route("/predefinie/{id}/edit", name="commande_predefine_edit", methods={"GET","POST"})
     */
    public function editfiligrame(Request $request, CommandePredefine $commandePredefine): Response
    {
        $form = $this->createForm(CommandePredefineType::class, $commandePredefine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager(); 
            $entityManager->flush();

            return $this->redirectToRoute('commande_predefine_index');
        }

        return $this->render('commande_predefine/edit.html.twig', [
            'commande_predefine' => $commandePredefine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/predefinie/{id}", name="commande_predefine_delete", methods={"DELETE"})
     */
    public function deletefiligrame(Request $request, CommandePredefine $commandePredefine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandePredefine->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandePredefine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_predefine_index');
    }

    /**
     * @Route("/finale", name="commande_finale_index", methods={"GET"})
     */
    public function finale(CommandeFinaleRepository $commandeFinaleRepository): Response
    {
        return $this->render('commande_finale/index.html.twig', [
            'commande_finales' => $commandeFinaleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/finale/ajouter/finale/{id}", name="commande_finale_new", methods={"GET","POST"})
     */
    public function newfinale(Request $request,CommandeLogo $commandeLogo): Response
    {
        $commandeFinale = new CommandeFinale();
        $form = $this->createForm(CommandeFinaleType::class, $commandeFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commandeFinale->setUser($this->getUser());
            $commandeLogo->setEtat('1');
            $commandeFinale->setCommandelogo($commandeLogo); 
            $entityManager->persist($commandeFinale);  
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
     * @Route("/finale/show/finale/{id}", name="commande_finale_show", methods={"GET"})
     */
    public function showfinale(CommandeFinale $commandeFinale): Response
    {
        
        return $this->render('commande_finale/show.html.twig', [
            'commande_finale' => $commandeFinale, 
            
        ]);
    }

    /**
     * @Route("/finale/edit/{id}", name="commande_finale_edit", methods={"GET","POST"})
     */
    public function editfinale(Request $request, CommandeFinale $commandeFinale): Response
    {
        $form = $this->createForm(CommandeFinaleType::class, $commandeFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager(); 
            $entityManager->flush();

            return $this->redirectToRoute('admin_commande_logo_index');
        }

        return $this->render('commande_finale/edit.html.twig', [
            'commande_finale' => $commandeFinale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/finale/{id}", name="commande_finale_delete", methods={"DELETE"})
     */
    public function deletefinale(Request $request, CommandeFinale $commandeFinale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeFinale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandeFinale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_commande_logo_index');
    }
}
