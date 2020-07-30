<?php

namespace App\Controller\Profil;

use App\Entity\ServicesGraphisme;
use App\Entity\CommandeLogo;
use App\Entity\CommandePredefine;
use App\Form\CommandeLogoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
