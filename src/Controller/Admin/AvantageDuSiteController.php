<?php

namespace App\Controller\Admin;

use App\Entity\AvantageDuSite;
use App\Form\AvantageDuSiteType;
use App\Repository\AvantageDuSiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** 
 * @Route("/admin/avantage/du/site", name="admin_")
 */
class AvantageDuSiteController extends AbstractController
{
    /**
     * @Route("/", name="avantage_du_site_index", methods={"GET"})
     */
    public function index(AvantageDuSiteRepository $avantageDuSiteRepository): Response
    {
        return $this->render('Admin/avantage_du_site/index.html.twig', [
            'avantage_du_sites' => $avantageDuSiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="avantage_du_site_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $avantageDuSite = new AvantageDuSite();
        $form = $this->createForm(AvantageDuSiteType::class, $avantageDuSite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avantageDuSite);
            $entityManager->flush();

            return $this->redirectToRoute('admin_avantage_du_site_index');
        }

        return $this->render('Admin/avantage_du_site/new.html.twig', [
            'avantage_du_site' => $avantageDuSite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="avantage_du_site_show", methods={"GET"})
     */
    public function show(AvantageDuSite $avantageDuSite): Response
    {
        return $this->render('Admin/avantage_du_site/show.html.twig', [
            'avantage_du_site' => $avantageDuSite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="avantage_du_site_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AvantageDuSite $avantageDuSite): Response
    {
        $form = $this->createForm(AvantageDuSiteType::class, $avantageDuSite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_avantage_du_site_index');
        }

        return $this->render('Admin/avantage_du_site/edit.html.twig', [
            'avantage_du_site' => $avantageDuSite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="avantage_du_site_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AvantageDuSite $avantageDuSite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avantageDuSite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($avantageDuSite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_avantage_du_site_index');
    }
}
