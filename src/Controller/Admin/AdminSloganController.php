<?php

namespace App\Controller\Admin;

use App\Entity\Slogan;
use App\Form\SloganType;
use App\Repository\SloganRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** 
 * @Route("/admin/slogan", name="admin_")
 */
class AdminSloganController extends AbstractController
{
    /**
     * @Route("/", name="slogan_index", methods={"GET"})
     */
    public function index(SloganRepository $sloganRepository): Response
    {
        return $this->render('Admin/slogan/index.html.twig', [
            'slogans' => $sloganRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="slogan_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $slogan = new Slogan();
        $form = $this->createForm(SloganType::class, $slogan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $slogan->setUser($this->getUser());
            $entityManager->persist($slogan);
            $entityManager->flush();

            return $this->redirectToRoute('admin_slogan_index');
        }

        return $this->render('Admin/slogan/new.html.twig', [
            'slogan' => $slogan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="slogan_show", methods={"GET"})
     */
    public function show(Slogan $slogan): Response
    {
        return $this->render('Admin/slogan/show.html.twig', [
            'slogan' => $slogan,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="slogan_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Slogan $slogan): Response
    {
        $form = $this->createForm(SloganType::class, $slogan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_slogan_index');
        }

        return $this->render('Admin/slogan/edit.html.twig', [
            'slogan' => $slogan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="slogan_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Slogan $slogan): Response
    {
        if ($this->isCsrfTokenValid('delete'.$slogan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($slogan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_slogan_index');
    }
}
