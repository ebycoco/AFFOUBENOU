<?php

namespace App\Controller\Admin\Graphisme\Badge;

use App\Entity\Badges;
use App\Entity\BadgesFiligramme;
use App\Form\BadgesFiligrammeType;
use App\Repository\BadgesFiligrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/badges-filigramme", name="admin_")
 */
class BadgesFiligrammeController extends AbstractController
{
    /**
     * @Route("/index", name="badges_filigramme_index", methods={"GET"})
     */
    public function index(BadgesFiligrammeRepository $badgesFiligrammeRepository): Response
    {
        return $this->render('Admin/admin_graphisme/badge/badges_filigramme/index.html.twig', [
            'badges_filigrammes' => $badgesFiligrammeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="badges_filigramme_new", methods={"GET","POST"})
     */
    public function new(Request $request,Badges $badge): Response
    {
        $badgesFiligramme = new BadgesFiligramme();
        $form = $this->createForm(BadgesFiligrammeType::class, $badgesFiligramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $badgesFiligramme->setUser($this->getUser());
            $badgesFiligramme->setBadge($badge);
            $badge->setEtat('niveau 2');
            $badge->setPredefinie($badgesFiligramme);
            $entityManager->persist($badgesFiligramme);
            $entityManager->flush();

            return $this->redirectToRoute('admin_badge_index');
        }

        return $this->render('Admin/admin_graphisme/badge/badges_filigramme/new.html.twig', [
            'badges_filigramme' => $badgesFiligramme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badges_filigramme_show", methods={"GET"})
     */
    public function show(BadgesFiligramme $badgesFiligramme): Response
    {
        return $this->render('Admin/admin_graphisme/badge/badges_filigramme/show.html.twig', [
            'badges_filigramme' => $badgesFiligramme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="badges_filigramme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BadgesFiligramme $badgesFiligramme): Response
    {
        $form = $this->createForm(BadgesFiligrammeType::class, $badgesFiligramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_badge_index');
        }

        return $this->render('Admin/admin_graphisme/badge/badges_filigramme/edit.html.twig', [
            'badges_filigramme' => $badgesFiligramme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badges_filigramme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BadgesFiligramme $badgesFiligramme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$badgesFiligramme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($badgesFiligramme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_badge_index');
    }
}
