<?php

namespace App\Controller\Profil\Graphisme\Affiche;

use App\Entity\Affiche;
use App\Form\AfficheType;
use App\Repository\AfficheRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile/affiche", name="profile_")
 */
class AfficheController extends AbstractController
{
    /** 
     * @Route("/", name="affiche_index", methods={"GET"})
     */
    public function index(AfficheRepository $afficheRepository): Response
    {
        return $this->render('profil/graphisme/affiche/index.html.twig', [
            'affiches' => $afficheRepository->findAll(),
        ]);
    }

    /* Debut les affiche de la partie profile */

    /**
     * Elle permet de lister les affiche simple dans la partie commande du profile
     *  
     * @Route(" /commande", name="commande_affiche", methods={"GET"})
     */
    public function commandeaffiche(AfficheRepository $afficheRepository, PaginatorInterface $paginator,Request $request): Response
    {
        $affiches = $paginator->paginate(
            $afficheRepository->findAllVisibleQuery($this->getUser()),
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        return $this->render('profil/commandeaffiche.html.twig',[ 
            'affiches' => $affiches,
        ]);
    } 

    /**
     * @Route("/new", name="affiche_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $affiche = new Affiche();
        $form = $this->createForm(AfficheType::class, $affiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $affiche->setUser($this->getUser());
            $affiche->setEtat('niveau 1');
            $affiche->setPrix('5000');
            $entityManager->persist($affiche);
            $entityManager->flush();
            $this->addFlash('success', 'Votre achat à été effectuer avec success');
            return $this->redirectToRoute('profile_commande');
        }

        return $this->render('profil/graphisme/affiche/new.html.twig', [
            'affiche' => $affiche,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="affiche_show", methods={"GET"})
     */
    public function show(Affiche $affiche): Response
    {
        return $this->render('profil/graphisme/affiche/show.html.twig', [
            'affiche' => $affiche,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="affiche_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Affiche $affiche): Response
    {
        $form = $this->createForm(AfficheType::class, $affiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('affiche_index');
        }

        return $this->render('profil/graphisme/affiche/edit.html.twig', [
            'affiche' => $affiche,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="affiche_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Affiche $affiche): Response
    {
        if ($this->isCsrfTokenValid('delete'.$affiche->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($affiche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('affiche_index');
    }
}
