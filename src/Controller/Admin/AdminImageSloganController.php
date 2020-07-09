<?php

namespace App\Controller\Admin;

use App\Entity\ImageSlogan;
use App\Form\ImageSloganType;
use App\Repository\ImageSloganRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** 
 * @Route("/admin/image/slogan", name="admin_")
 */
class AdminImageSloganController extends AbstractController
{
    /**
     * @Route("/", name="image_slogan_index", methods={"GET"})
     */
    public function index(ImageSloganRepository $imageSloganRepository): Response
    {
        return $this->render('Admin/image_slogan/index.html.twig', [
            'image_slogans' => $imageSloganRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="image_slogan_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $imageSlogan = new ImageSlogan();
        $form = $this->createForm(ImageSloganType::class, $imageSlogan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $imageSlogan->setUser($this->getUser());
            $entityManager->persist($imageSlogan);
            $entityManager->flush();

            return $this->redirectToRoute('admin_slogan_index');
        }

        return $this->render('Admin/image_slogan/new.html.twig', [
            'image_slogan' => $imageSlogan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="image_slogan_show", methods={"GET"})
     */
    public function show(ImageSlogan $imageSlogan): Response
    {
        return $this->render('Admin/image_slogan/show.html.twig', [
            'image_slogan' => $imageSlogan,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="image_slogan_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ImageSlogan $imageSlogan): Response
    {
        $form = $this->createForm(ImageSloganType::class, $imageSlogan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_image_slogan_index');
        }

        return $this->render('Admin/image_slogan/edit.html.twig', [
            'image_slogan' => $imageSlogan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="image_slogan_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ImageSlogan $imageSlogan): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imageSlogan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($imageSlogan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_image_slogan_index');
    }
}
