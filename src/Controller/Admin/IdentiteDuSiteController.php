<?php

namespace App\Controller\Admin;

use App\Entity\IdentiteDuSite;
use App\Form\IdentiteDuSiteType;
use App\Repository\IdentiteDuSiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** 
 * @Route("/admin/identite/du/site", name="admin_")
 */
class IdentiteDuSiteController extends AbstractController
{
    /**
     * @Route("/", name="identite_du_site_index", methods={"GET"})
     */
    public function index(IdentiteDuSiteRepository $identiteDuSiteRepository): Response
    {
        return $this->render('Admin/identite_du_site/index.html.twig', [
            'identite_du_sites' => $identiteDuSiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="identite_du_site_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $identiteDuSite = new IdentiteDuSite();
        $form = $this->createForm(IdentiteDuSiteType::class, $identiteDuSite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($identiteDuSite);
            $entityManager->flush();

            return $this->redirectToRoute('admin_identite_du_site_index');
        }

        return $this->render('Admin/identite_du_site/new.html.twig', [
            'identite_du_site' => $identiteDuSite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="identite_du_site_show", methods={"GET"})
     */
    public function show(IdentiteDuSite $identiteDuSite): Response
    {
        return $this->render('Admin/identite_du_site/show.html.twig', [
            'identite_du_site' => $identiteDuSite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="identite_du_site_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IdentiteDuSite $identiteDuSite): Response
    {
        $form = $this->createForm(IdentiteDuSiteType::class, $identiteDuSite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_identite_du_site_index');
        }

        return $this->render('Admin/identite_du_site/edit.html.twig', [
            'identite_du_site' => $identiteDuSite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="identite_du_site_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IdentiteDuSite $identiteDuSite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$identiteDuSite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($identiteDuSite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_identite_du_site_index');
    }
}
