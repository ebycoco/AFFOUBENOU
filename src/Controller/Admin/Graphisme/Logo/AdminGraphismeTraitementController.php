<?php

namespace App\Controller\Admin\Graphisme\Logo;
use App\Entity\CommandeLogo;
use App\Form\CommandeLogoType;
use App\Entity\CommandePredefine;
use App\Entity\CommandeLogoPersonalise;
use App\Repository\CommandeLogoRepository;
use App\Repository\CommandeFinaleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CommandePredefineRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommandePredefinieRepository;
use App\Repository\CommandeFinalePersoRepository;
use App\Repository\CommandeLogoPersonaliseRepository;
use App\Repository\CommandePredefiniePersoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/commande/traitement/logo", name="admin_")
 */

class AdminGraphismeTraitementController extends AbstractController
{
    /**
     * @Route("/", name="commande_logo_index", methods={"GET"})
     */
    public function index(CommandeLogoRepository $commandeLogoRepository,CommandeLogoPersonaliseRepository $commandeLogoPersonaliseRepo): Response
    { 
        return $this->render('Admin/admin_graphisme/logo/commande_logo/index.html.twig', [
            'commande_logos' => $commandeLogoRepository->findByLast(),  
            'commande_logoPerso' => $commandeLogoPersonaliseRepo->findAll(),  
        ]);
    }

    /**
     * @Route("/travail", name="commande_logo_travail", methods={"GET"})
     */
    public function travail(CommandePredefineRepository $commandePredefineRepository,CommandeFinaleRepository $commandeFinaleRepository,CommandeFinalePersoRepository $commandeFinalePersoRepository): Response
    { 
        return $this->render('Admin/admin_graphisme/logo/commande_logo/travail.html.twig', [ 
            'commande_logo_pres' => $commandePredefineRepository->findByLast(),
            'commande_logo_finale' => $commandeFinaleRepository->findByLast(), 
            'commande_logo_finale_persos' => $commandeFinalePersoRepository->findAll(), 
        ]);
    }

    /**
     * @Route("/logo/{id}", name="commande_logo_show", methods={"GET"})
     */
    public function showlogo(CommandeLogo $commandeLogo): Response
    {
        return $this->render('Admin/admin_graphisme/logo/commande_logo/show.html.twig', [
            'commande_logo' => $commandeLogo, 
        ]);
    }

    /**
     * @Route("/logoperso/{id}", name="commande_logo_showperso", methods={"GET"})
     */
    public function showlogoperso(CommandeLogoPersonalise $commandeLogoPersonalise): Response
    {
        return $this->render('Admin/admin_graphisme/logo/commande_logo/showperso.html.twig', [
            'commande_logoPerso' => $commandeLogoPersonalise,
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

        return $this->render('Admin/admin_graphisme/logo/commande_logo/edit.html.twig', [
            'commande_logo' => $commandeLogo,
            'form' => $form->createView(),
        ]);
    }
}