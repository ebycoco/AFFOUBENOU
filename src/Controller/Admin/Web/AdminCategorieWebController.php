<?php

namespace App\Controller\Admin\Web;;

use App\Entity\CategorieWeb;
use App\Form\CategorieWebType;
use App\Repository\CategorieWebRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/categorie-web",name="admin_")
 */
class AdminCategorieWebController extends AbstractController
{
    /**
     * @Route("/", name="categorie_web_index", methods={"GET"})
     */
    public function index(CategorieWebRepository $categorieWebRepository): Response
    {
        return $this->render('Admin/admin_siteWeb/categorie_web/index.html.twig', [
            'categorie_webs' => $categorieWebRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="categorie_web_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorieWeb = new CategorieWeb();
        $form = $this->createForm(CategorieWebType::class, $categorieWeb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $categorieWeb->setUser($this->getUser());
            $entityManager->persist($categorieWeb);
            $entityManager->flush();

            return $this->redirectToRoute('admin_categorie_web_index');
        }

        return $this->render('Admin/admin_siteWeb/categorie_web/new.html.twig', [
            'categorie_web' => $categorieWeb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_web_show", methods={"GET"})
     */
    public function show(CategorieWeb $categorieWeb): Response
    {
        return $this->render('Admin/admin_siteWeb/categorie_web/show.html.twig', [
            'categorie_web' => $categorieWeb,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categorie_web_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CategorieWeb $categorieWeb): Response
    {
        $form = $this->createForm(CategorieWebType::class, $categorieWeb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_categorie_web_index');
        }

        return $this->render('Admin/admin_siteWeb/categorie_web/edit.html.twig', [
            'categorie_web' => $categorieWeb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="categorie_web_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CategorieWeb $categorieWeb): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieWeb->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorieWeb);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_categorie_web_index');
    }
}
