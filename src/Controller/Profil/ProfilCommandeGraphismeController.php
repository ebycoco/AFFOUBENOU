<?php

namespace App\Controller\Profil;

use App\Entity\ServicesGraphisme;
use App\Entity\CommandeLogo;
use App\Entity\CommandePredefine;
use App\Form\CommandeLogoType;
use App\Entity\CommandeLogoPersonalise;
use App\Form\CommandeLogoPersonaliseType;
use App\Repository\CommandeLogoPersonaliseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *  @Route("/profile", name="profile_")
 */

class ProfilCommandeGraphismeController extends AbstractController
{
    /**
     * @Route("/commande/logo/{id}", name="commande_graphisme", methods={"GET","POST"})
     */
    public function logo(ServicesGraphisme $servicesGraphisme, Request $request)
    {
        $commandeLogo = new CommandeLogo();
            $form = $this->createForm(CommandeLogoType::class, $commandeLogo);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $commandeLogo->setUser($this->getUser());
                $commandeLogo->setServicesGraphisme($servicesGraphisme);
                $commandeLogo->setTypelogo('Logo non pesonnalisé');
                $entityManager->persist($commandeLogo);
                $entityManager->flush();
                return $this->redirectToRoute('profile_commande');
            }
            return $this->render('profil/graphisme/logo/commande_logo.html.twig', [
                'services' => $servicesGraphisme,
                'commande_logo' => $commandeLogo,
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/commande/logo/predefinie/{id}", name="commande_graphisme_fili", methods={"GET","POST"})
     */
    public function logofiligrame(CommandePredefine $commandePredefine)
    {
        return $this->render('profil/graphisme/logo/filigrame_logo.html.twig', [
            'commandePredefine' => $commandePredefine,
        ]);
    }

    /**
     * @Route("/commande/logo/paiement/{id}", name="commande_graphisme_mod", methods={"GET","POST"})
     */
    public function modepaiement(CommandePredefine $commandePredefine)
    {
        return $this->render('profil/graphisme/logo/paiementLogo.html.twig', [
            'commandePredefine' => $commandePredefine,
        ]);
    }

    /**
     * @Route("/commande/logo/personnalise/new", name="commande_logo_personalise_new", methods={"GET","POST"})
     */
    public function personnaliselogo(Request $request): Response
    {
        $commandeLogoPersonalise = new CommandeLogoPersonalise();
        $form = $this->createForm(CommandeLogoPersonaliseType::class, $commandeLogoPersonalise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commandeLogoPersonalise->setUser($this->getUser());
            $commandeLogoPersonalise->setPrix('10000');
            $entityManager->persist($commandeLogoPersonalise);
            $entityManager->flush();

            return $this->redirectToRoute('profile_commande');
        }

        return $this->render('profil/graphisme/logo/new.html.twig', [
            'commande_logo_personalise' => $commandeLogoPersonalise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/commande/logo/personnalise/{id}", name="commande_logo_personalise_show", methods={"GET"})
     */
    public function show(CommandeLogoPersonalise $commandeLogoPersonalise): Response
    {
        return $this->render('commande_logo_personalise/show.html.twig', [
            'commande_logo_personalise' => $commandeLogoPersonalise,
            ]);
    }
}
