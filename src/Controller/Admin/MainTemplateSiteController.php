<?php

namespace App\Controller\Admin;

use App\Entity\MainTemplateSite;
use App\Form\MainTemplateSiteType;
use App\Repository\MainTemplateSiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/main/template/site", name="admin_")
 */
class MainTemplateSiteController extends AbstractController
{
    /**
     * @Route("/", name="main_template_site_index", methods={"GET"})
     */
    public function index(MainTemplateSiteRepository $mainTemplateSiteRepository): Response
    {
        return $this->render('Admin/main_template_site/index.html.twig', [
            'main_template_sites' => $mainTemplateSiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="main_template_site_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mainTemplateSite = new MainTemplateSite();
        $form = $this->createForm(MainTemplateSiteType::class, $mainTemplateSite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mainTemplateSite->setUser($this->getUser());
            $entityManager->persist($mainTemplateSite);
            $entityManager->flush();

            return $this->redirectToRoute('admin_main_template_site_index');
        }

        return $this->render('Admin/main_template_site/new.html.twig', [
            'main_template_site' => $mainTemplateSite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_template_site_show", methods={"GET"})
     */
    public function show(MainTemplateSite $mainTemplateSite): Response
    {
        return $this->render('main_template_site/show.html.twig', [
            'main_template_site' => $mainTemplateSite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="main_template_site_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MainTemplateSite $mainTemplateSite): Response
    {
        $form = $this->createForm(MainTemplateSiteType::class, $mainTemplateSite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_main_template_site_index');
        }

        return $this->render('Admin/main_template_site/edit.html.twig', [
            'main_template_site' => $mainTemplateSite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_template_site_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MainTemplateSite $mainTemplateSite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainTemplateSite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mainTemplateSite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_main_template_site_index');
    }
}
