<?php

namespace App\Controller\Admin;

use App\Entity\MainLogo;
use App\Form\MainLogoType;
use App\Repository\MainLogoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/main/logo", name="admin_")
 */
class MainLogoController extends AbstractController
{
    /**
     * @Route("/", name="main_logo_index", methods={"GET"})
     */
    public function index(MainLogoRepository $mainLogoRepository): Response
    {
        return $this->render('Admin/main_logo/index.html.twig', [
            'main_logos' => $mainLogoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="main_logo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mainLogo = new MainLogo();
        $form = $this->createForm(MainLogoType::class, $mainLogo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mainLogo->setUser($this->getUser());
            $entityManager->persist($mainLogo);
            $entityManager->flush();

            return $this->redirectToRoute('admin_main_logo_index');
        }

        return $this->render('Admin/main_logo/new.html.twig', [
            'main_logo' => $mainLogo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_logo_show", methods={"GET"})
     */
    public function show(MainLogo $mainLogo): Response
    {
        return $this->render('Admin/main_logo/show.html.twig', [
            'main_logo' => $mainLogo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="main_logo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MainLogo $mainLogo): Response
    {
        $form = $this->createForm(MainLogoType::class, $mainLogo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_main_logo_index');
        }

        return $this->render('Admin/main_logo/edit.html.twig', [
            'main_logo' => $mainLogo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_logo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MainLogo $mainLogo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainLogo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mainLogo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_main_logo_index');
    }
}
