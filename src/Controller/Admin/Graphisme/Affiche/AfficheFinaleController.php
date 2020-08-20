<?php

namespace App\Controller\Admin\Graphisme\Affiche;

use App\Entity\Affiche;
use App\Entity\AfficheFinale;
use App\Form\AfficheFinaleType;
use App\Repository\AfficheFinaleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/commande/affiche-finale", name="admin_")
 */
class AfficheFinaleController extends AbstractController
{
    /**
     * @Route("/index", name="affiche_finale_index", methods={"GET"})
     */
    public function index(AfficheFinaleRepository $afficheFinaleRepository): Response
    {
        
        return $this->render('Admin/admin_graphisme/affiche/affiche_finale/index.html.twig', [
            'affiche_finales' => $afficheFinaleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="affiche_finale_new", methods={"GET","POST"})
     */
    public function new(Request $request,Affiche $affiche): Response
    {
        $afficheFinale = new AfficheFinale();
        $form = $this->createForm(AfficheFinaleType::class, $afficheFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $afficheFinale->setUser($this->getUser());
            $afficheFinale->setAffiche($affiche);
            $affiche->setEtat('niveau 3');
            $entityManager->persist($afficheFinale);
            $entityManager->flush();

            return $this->redirectToRoute('admin_affiche_index');
        }

        return $this->render('Admin/admin_graphisme/affiche/affiche_finale/new.html.twig', [
            'affiche_finale' => $afficheFinale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="affiche_finale_show", methods={"GET"})
     */
    public function show(AfficheFinale $afficheFinale): Response
    {
        return $this->render('Admin/admin_graphisme/affiche/affiche_finale/show.html.twig', [
            'affiche_finale' => $afficheFinale,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="affiche_finale_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AfficheFinale $afficheFinale): Response
    {
        $form = $this->createForm(AfficheFinaleType::class, $afficheFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_affiche_index');
        }

        return $this->render('Admin/admin_graphisme/affiche/affiche_finale/edit.html.twig', [
            'affiche_finale' => $afficheFinale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="affiche_finale_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AfficheFinale $afficheFinale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$afficheFinale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($afficheFinale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_affiche_index');
    }
}
