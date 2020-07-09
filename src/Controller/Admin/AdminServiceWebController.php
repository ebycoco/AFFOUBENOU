<?php

namespace App\Controller\Admin;

use App\Entity\ServiceWeb;
use App\Form\ServiceWebType;
use App\Repository\ServiceWebRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/service/web", name="admin_")
 */
class AdminServiceWebController extends AbstractController
{
    /**
     * @Route("/", name="service_web_index", methods={"GET"})
     */
    public function index(ServiceWebRepository $serviceWebRepository): Response
    {
        return $this->render('Admin/service_web/index.html.twig', [
            'service_webs' => $serviceWebRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="service_web_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $serviceWeb = new ServiceWeb();
        $form = $this->createForm(ServiceWebType::class, $serviceWeb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $serviceWeb->setUser($this->getUser());
            $entityManager->persist($serviceWeb);
            $entityManager->flush();

            return $this->redirectToRoute('admin_service_web_index');
        }

        return $this->render('Admin/service_web/new.html.twig', [
            'service_web' => $serviceWeb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_web_show", methods={"GET"})
     */
    public function show(ServiceWeb $serviceWeb): Response
    {
        return $this->render('Admin/service_web/show.html.twig', [
            'service_web' => $serviceWeb,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="service_web_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ServiceWeb $serviceWeb): Response
    {
        $form = $this->createForm(ServiceWebType::class, $serviceWeb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_service_web_index');
        }

        return $this->render('Admin/service_web/edit.html.twig', [
            'service_web' => $serviceWeb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_web_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ServiceWeb $serviceWeb): Response
    {
        if ($this->isCsrfTokenValid('delete'.$serviceWeb->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($serviceWeb);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_service_web_index');
    }
}
