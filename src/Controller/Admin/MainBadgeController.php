<?php

namespace App\Controller\Admin;

use App\Entity\MainBadge;
use App\Form\MainBadgeType;
use App\Repository\MainBadgeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/main/badge", name="admin_")
 */
class MainBadgeController extends AbstractController
{
    /**
     * @Route("/", name="main_badge_index", methods={"GET"})
     */
    public function index(MainBadgeRepository $mainBadgeRepository): Response
    {
        return $this->render('Admin/main_badge/index.html.twig', [
            'main_badges' => $mainBadgeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="main_badge_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mainBadge = new MainBadge();
        $form = $this->createForm(MainBadgeType::class, $mainBadge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mainBadge->setUser($this->getUser());
            $entityManager->persist($mainBadge);
            $entityManager->flush();

            return $this->redirectToRoute('admin_main_badge_index');
        }

        return $this->render('Admin/main_badge/new.html.twig', [
            'main_badge' => $mainBadge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_badge_show", methods={"GET"})
     */
    public function show(MainBadge $mainBadge): Response
    {
        return $this->render('Admin/main_badge/show.html.twig', [
            'main_badge' => $mainBadge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="main_badge_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MainBadge $mainBadge): Response
    {
        $form = $this->createForm(MainBadgeType::class, $mainBadge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_main_badge_index');
        }

        return $this->render('Admin/main_badge/edit.html.twig', [
            'main_badge' => $mainBadge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_badge_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MainBadge $mainBadge): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainBadge->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mainBadge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_main_badge_index');
    }
}
