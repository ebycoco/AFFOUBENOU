<?php

namespace App\Controller\Admin;

use App\Entity\Graphisme;
use App\Form\GraphismeType;
use App\Repository\GraphismeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** 
 * @Route("/admin/graphisme", name="admin_")
 */
class AdminGraphismeController extends AbstractController
{
    /**
     * @Route("/", name="graphisme_index", methods={"GET"})
     */
    public function index(GraphismeRepository $graphismeRepository): Response
    {
        return $this->render('Admin/graphisme/index.html.twig', [
            'graphismes' => $graphismeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="graphisme_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $graphisme = new Graphisme();
        $form = $this->createForm(GraphismeType::class, $graphisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $graphisme->setUser($this->getUser());
            $entityManager->persist($graphisme);
            $entityManager->flush();

            return $this->redirectToRoute('admin_graphisme_index');
        }

        return $this->render('Admin/graphisme/new.html.twig', [
            'graphisme' => $graphisme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="graphisme_show", methods={"GET"})
     */
    public function show(Graphisme $graphisme): Response
    {
        return $this->render('Admin/graphisme/show.html.twig', [
            'graphisme' => $graphisme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="graphisme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Graphisme $graphisme): Response
    {
        $form = $this->createForm(GraphismeType::class, $graphisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_graphisme_index');
        }

        return $this->render('Admin/graphisme/edit.html.twig', [
            'graphisme' => $graphisme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="graphisme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Graphisme $graphisme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$graphisme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($graphisme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_graphisme_index');
    }
}
