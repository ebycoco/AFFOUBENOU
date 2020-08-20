<?php

namespace App\Controller\Admin\Graphisme\Affiche;

use App\Entity\Affiche;
use App\Entity\AfficheFiligrame;
use App\Form\AfficheFiligrameType;
use App\Repository\AfficheFinaleRepository;
use App\Repository\CarteMenuFinaleRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\AfficheFiligrameRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/affiche-filigrame", name="admin_")
 */
class AfficheFiligrameController extends AbstractController
{
    /**
     * @Route("/index", name="affiche_filigrame_index", methods={"GET"})
     */
    public function index(AfficheFiligrameRepository $afficheFiligrameRepository): Response
    {
        return $this->render('Admin/admin_graphisme/affiche/affiche_filigrame/index.html.twig', [
            'affiche_filigrames' => $afficheFiligrameRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="affiche_filigrame_new", methods={"GET","POST"})
     */
    public function new(Request $request,Affiche $affiche): Response
    {
        $afficheFiligrame = new AfficheFiligrame();
        $form = $this->createForm(AfficheFiligrameType::class, $afficheFiligrame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $afficheFiligrame->setUser($this->getUser());
            $afficheFiligrame->setAffiche($affiche);
            $affiche->setEtat('niveau 2');
            $affiche->setPredefinie($afficheFiligrame);
            $entityManager->persist($afficheFiligrame);
            $entityManager->flush();

            return $this->redirectToRoute('admin_affiche_index');
        }

        return $this->render('Admin/admin_graphisme/affiche/affiche_filigrame/new.html.twig', [
            'affiche_filigrame' => $afficheFiligrame,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="affiche_filigrame_show", methods={"GET"})
     */
    public function show(AfficheFiligrame $afficheFiligrame): Response
    {
        return $this->render('Admin/admin_graphisme/affiche/affiche_filigrame/show.html.twig', [
            'affiche_filigrame' => $afficheFiligrame,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="affiche_filigrame_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AfficheFiligrame $afficheFiligrame): Response
    {
        $form = $this->createForm(AfficheFiligrameType::class, $afficheFiligrame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_affiche_index');
        }

        return $this->render('Admin/admin_graphisme/affiche/affiche_filigrame/edit.html.twig', [
            'affiche_filigrame' => $afficheFiligrame,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="affiche_filigrame_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AfficheFiligrame $afficheFiligrame): Response
    {
        if ($this->isCsrfTokenValid('delete'.$afficheFiligrame->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($afficheFiligrame);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_affiche_index');
    }
}
