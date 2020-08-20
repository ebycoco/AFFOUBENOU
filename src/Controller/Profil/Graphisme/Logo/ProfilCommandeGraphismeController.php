<?php

namespace App\Controller\Profil\Graphisme\Logo;

use App\Entity\ServicesGraphisme;
use App\Entity\CommandeLogo;
use App\Entity\CommandePredefine;
use App\Form\CommandeLogoType;
use App\Entity\CommandeLogoPersonalise;
use App\Entity\CommandePredefiniePerso;
use App\Form\CommandeLogoPersonaliseType;
use App\Repository\CommandeLogoPersonaliseRepository;
use App\Repository\CommandeLogoRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *  @Route("/profile/logo", name="profile_")
 */

class ProfilCommandeGraphismeController extends AbstractController
{
    /* Afficher les logo de la partie profile */

    /**
     * Elle permet de lister les logo simple dans la partie commande du profile 
     * @Route("/commande/logo-simple", name="commande", methods={"GET"})
     */
    public function commandeGrap(CommandeLogoRepository $commandeLogoRepository, PaginatorInterface $paginator,Request $request): Response
    {
        $logosimple = $paginator->paginate(
            $commandeLogoRepository->findAllVisibleQuery($this->getUser()),
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('profil/commande.html.twig',[
            'commande_logos' => $logosimple, 
        ]);
    } 

    /**
     * Elle permet de lister les logo personnalise dans la partie commande du profile 
     * @Route("/commande/logo-personnalise", name="commande_perso", methods={"GET"})
     */
    public function commandeGrapperso(CommandeLogoPersonaliseRepository $commandeLogoPersonaliseRepository, PaginatorInterface $paginator,Request $request): Response
    {
        $logoperso = $paginator->paginate(
            $commandeLogoPersonaliseRepository->findAllVisibleQuery($this->getUser()),
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('profil/commandeperso.html.twig',[ 
            'commande_logo_personalises' => $logoperso,
        ]);
    } 

    /**
     * @Route(" /{id}", name="commande_graphisme", methods={"GET","POST"})
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
                $this->addFlash('success', 'Votre achat à été effectuer avec success');
            return $this->redirectToRoute('profile_commande');
            }
            return $this->render('profil/graphisme/logo/commande_logo.html.twig', [
                'services' => $servicesGraphisme,
                'commande_logo' => $commandeLogo,
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/predefinie/{id}", name="commande_graphisme_fili", methods={"GET","POST"})
     */
    public function logofiligrame(CommandePredefine $commandePredefine)
    {
        return $this->render('profil/graphisme/logo/filigrame_logo.html.twig', [
            'commandePredefine' => $commandePredefine,
        ]);
    }

    /**
     * @Route(" /predefinie/perso/{id}", name="commande_graphisme_fili_perso", methods={"GET","POST"})
     */
    public function logofiligrameperso(CommandePredefiniePerso $commandePredefiniePerso)
    {
        return $this->render('profil/graphisme/logo/filigrame_logo_perso.html.twig', [
            'commandePredefiniePerso' => $commandePredefiniePerso,
        ]);
    }

    /**
     * @Route(" /paiement/{id}", name="commande_graphisme_mod", methods={"GET","POST"})
     */
    public function modepaiement(CommandePredefine $commandePredefine)
    {
        return $this->render('profil/graphisme/logo/paiementLogo.html.twig', [
            'commandePredefine' => $commandePredefine,
        ]);
    }

    /**
     * @Route("/perso/paiement/{id}", name="commande_graphisme_mod_perso", methods={"GET","POST"})
     */
    public function modepaiementperso(CommandePredefiniePerso $commandePredefiniePerso)
    {
        return $this->render('profil/graphisme/logo/paiementLogoPerso.html.twig', [
            'commandePredefinieperso' => $commandePredefiniePerso,
        ]);
    }

    /**
     * @Route(" /personnalise/new", name="commande_logo_personalise_new", methods={"GET","POST"})
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
            $commandeLogoPersonalise->setChoix('Personnalise'); 
            $commandeLogoPersonalise->setNiveau('niveau 1'); 
            $entityManager->persist($commandeLogoPersonalise);
            $entityManager->flush();

            $this->addFlash('success', 'Votre achat à été effectuer avec success');
            return $this->redirectToRoute('profile_commande');
        }

        return $this->render('profil/graphisme/logo/new.html.twig', [
            'commande_logo_personalise' => $commandeLogoPersonalise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route(" /personnalise/{id}", name="commande_logo_personalise_show", methods={"GET"})
     */
    public function show(CommandeLogoPersonalise $commandeLogoPersonalise): Response
    {
        return $this->render('commande_logo_personalise/show.html.twig', [
            'commande_logo_personalise' => $commandeLogoPersonalise,
            ]);
    }
}
