<?php

namespace App\Controller\Admin;
use App\Entity\CommandeLogo;
use App\Entity\CommandePredefine;
use App\Form\CommandeLogoType;
use App\Repository\CommandeFinaleRepository;
use App\Repository\CommandeLogoRepository;
use App\Repository\CommandePredefineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/commande/logo", name="admin_")
 */

class AdminGraphismeTraitementController extends AbstractController
{
    /**
     * @Route("/", name="commande_logo_index", methods={"GET"})
     */
    public function index(CommandeLogoRepository $commandeLogoRepository,CommandePredefineRepository $commandePredefineRepository,CommandeFinaleRepository $commandeFinaleRepository): Response
    { 
        return $this->render('commande_logo/index.html.twig', [
            'commande_logos' => $commandeLogoRepository->findAll(),
            'commande_logo_pres' => $commandePredefineRepository->findAll(),
            'commande_logo_finale' => $commandeFinaleRepository->findAll(),
            'commande_predefinies' => $commandePredefineRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_logo_show", methods={"GET"})
     */
    public function show(CommandeLogo $commandeLogo): Response
    {
        return $this->render('commande_logo/show.html.twig', [
            'commande_logo' => $commandeLogo,
        ]);
    }
 
    /**
     * @Route("/{id}/edit", name="commande_logo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommandeLogo $commandeLogo): Response
    {
        $form = $this->createForm(CommandeLogoType::class, $commandeLogo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commandeLogo->setEtat('1');
            $entityManager->flush(); 
            return $this->redirectToRoute('commande_logo_index');
        }

        return $this->render('commande_logo/edit.html.twig', [
            'commande_logo' => $commandeLogo,
            'form' => $form->createView(),
        ]);
    }
}