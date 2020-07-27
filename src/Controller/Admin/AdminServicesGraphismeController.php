<?php

namespace App\Controller\Admin;

use App\Entity\ServicesGraphisme;
use App\Form\ServicesGraphismeType;
use App\Repository\ServicesGraphismeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/services/graphisme",name="admin_")
 */
class AdminServicesGraphismeController extends AbstractController
{
    /**
     * @Route("/", name="services_graphisme_index", methods={"GET"})
     */
    public function index(ServicesGraphismeRepository $servicesGraphismeRepository): Response
    {
        return $this->render('Admin/services_graphisme/index.html.twig', [
            'services_graphismes' => $servicesGraphismeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="services_graphisme_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $servicesGraphisme = new ServicesGraphisme();
        $form = $this->createForm(ServicesGraphismeType::class, $servicesGraphisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $servicesGraphisme->setUser($this->getUser());
            $entityManager->persist($servicesGraphisme);
            $entityManager->flush();

            return $this->redirectToRoute('admin_services_graphisme_index');
        }

        return $this->render('Admin/services_graphisme/new.html.twig', [
            'services_graphisme' => $servicesGraphisme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="services_graphisme_show", methods={"GET"})
     */
    public function show(ServicesGraphisme $servicesGraphisme): Response
    {
        return $this->render('Admin/services_graphisme/show.html.twig', [
            'services_graphisme' => $servicesGraphisme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="services_graphisme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ServicesGraphisme $servicesGraphisme): Response
    {
        $form = $this->createForm(ServicesGraphismeType::class, $servicesGraphisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_services_graphisme_index');
        }

        return $this->render('Admin/services_graphisme/edit.html.twig', [
            'services_graphisme' => $servicesGraphisme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="services_graphisme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ServicesGraphisme $servicesGraphisme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$servicesGraphisme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($servicesGraphisme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_services_graphisme_index');
    }
}
