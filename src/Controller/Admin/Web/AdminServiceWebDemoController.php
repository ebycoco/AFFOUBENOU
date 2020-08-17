<?php

namespace App\Controller\Admin\Web;

use App\Entity\CommandeServicesWeb;
use App\Entity\ServiceWebDemo;
use App\Form\ServiceWebDemoType;
use App\Repository\ServiceWebDemoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/service_web_demo", name="admin_")
 */ 
class AdminServiceWebDemoController extends AbstractController
{
    /**
     * @Route("/", name="service_web_demo_index", methods={"GET"})
     */
    public function index(ServiceWebDemoRepository $serviceWebDemoRepository): Response
    {
        return $this->render('Admin/admin_siteWeb/service_web_demo/index.html.twig', [
            'service_web_demos' => $serviceWebDemoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="service_web_demo_new", methods={"GET","POST"})
     */
    public function new(Request $request ,CommandeServicesWeb $commandeServicesWeb): Response
    {
        $serviceWebDemo = new ServiceWebDemo();
        $form = $this->createForm(ServiceWebDemoType::class, $serviceWebDemo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $serviceWebDemo->setUser($this->getUser());
            $commandeServicesWeb->setLien('active');
            $commandeServicesWeb->setDemo($serviceWebDemo);
            $serviceWebDemo->setCommandeServiceWeb($commandeServicesWeb);
            $entityManager->persist($serviceWebDemo);
            $entityManager->flush();

            return $this->redirectToRoute('admin_site_index');
        }

        return $this->render('Admin/admin_siteWeb/service_web_demo/new.html.twig', [
            'service_web_demo' => $serviceWebDemo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_web_demo_show", methods={"GET"})
     */
    public function show(ServiceWebDemo $serviceWebDemo): Response
    {
        return $this->render('Admin/admin_siteWeb/service_web_demo/show.html.twig', [
            'service_web_demo' => $serviceWebDemo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="service_web_demo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ServiceWebDemo $serviceWebDemo): Response
    {
        $form = $this->createForm(ServiceWebDemoType::class, $serviceWebDemo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_service_web_demo_index');
        }

        return $this->render('Admin/admin_siteWeb/service_web_demo/edit.html.twig', [
            'service_web_demo' => $serviceWebDemo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_web_demo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ServiceWebDemo $serviceWebDemo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$serviceWebDemo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($serviceWebDemo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_service_web_demo_index');
    }
}
