<?php

namespace App\Controller\Admin\Graphisme\CarteMenu;

use App\Entity\CarteMenu;
use App\Entity\CarteMenuFinale;
use App\Form\CarteMenuFinaleType;
use App\Repository\CarteMenuFinaleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/carte-menu/finale", name="admin_")
 */
class CarteMenuFinaleController extends AbstractController
{
    /**
     * @Route("/", name="carte_menu_finale_index", methods={"GET"})
     */
    public function index(CarteMenuFinaleRepository $carteMenuFinaleRepository): Response
    {
        return $this->render('Admin/admin_graphisme/carte_menu/carte_menu_finale/index.html.twig', [
            'carte_menu_finales' => $carteMenuFinaleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="carte_menu_finale_new", methods={"GET","POST"})
     */
    public function new(Request $request,CarteMenu $carteMenu): Response
    {
        $carteMenuFinale = new CarteMenuFinale();
        $form = $this->createForm(CarteMenuFinaleType::class, $carteMenuFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $carteMenuFinale->setUser($this->getUser());
            $carteMenuFinale->setCartemenu($carteMenu);
            $carteMenu->setEtat('niveau 3');
            $entityManager->persist($carteMenuFinale);
            $entityManager->flush();

            return $this->redirectToRoute('admin_carte_menu_index');
        }

        return $this->render('Admin/admin_graphisme/carte_menu/carte_menu_finale/new.html.twig', [
            'carte_menu_finale' => $carteMenuFinale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_menu_finale_show", methods={"GET"})
     */
    public function show(CarteMenuFinale $carteMenuFinale): Response
    {
        return $this->render('Admin/admin_graphisme/carte_menu/carte_menu_finale/show.html.twig', [
            'carte_menu_finale' => $carteMenuFinale,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carte_menu_finale_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CarteMenuFinale $carteMenuFinale): Response
    {
        $form = $this->createForm(CarteMenuFinaleType::class, $carteMenuFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carte_menu_finale_index');
        }

        return $this->render('Admin/admin_graphisme/carte_menu/carte_menu_finale/edit.html.twig', [
            'carte_menu_finale' => $carteMenuFinale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_menu_finale_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CarteMenuFinale $carteMenuFinale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carteMenuFinale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carteMenuFinale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carte_menu_finale_index');
    }
}
