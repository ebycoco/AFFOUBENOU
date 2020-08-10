<?php

namespace App\Controller\Admin\Graphisme\CarteViste;

use App\Entity\CarteVisite;
use App\Entity\CarteVisiteFinale;
use App\Form\CarteVisiteFinaleType;
use App\Repository\CarteVisiteFinaleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/carte/visite/finale", name="admin_")
 */
class CarteVisiteFinaleController extends AbstractController
{
    /**
     * @Route("/index", name="carte_visite_finale_index", methods={"GET"})
     */
    public function index(CarteVisiteFinaleRepository $carteVisiteFinaleRepository): Response
    {
        return $this->render('Admin/admin_graphisme/carte_visite/carte_visite_finale/index.html.twig', [
            'carte_visite_finales' => $carteVisiteFinaleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="carte_visite_finale_new", methods={"GET","POST"})
     */
    public function new(Request $request,CarteVisite $carteVisite): Response
    {
        $carteVisiteFinale = new CarteVisiteFinale();
        $form = $this->createForm(CarteVisiteFinaleType::class, $carteVisiteFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $carteVisiteFinale->setUser($this->getUser());
            $carteVisiteFinale->setCartevisite($carteVisite);
            $carteVisite->setEtat('niveau 3');
            $entityManager->persist($carteVisiteFinale);
            $entityManager->flush();

            return $this->redirectToRoute('admin_carte_visite_index');
        }

        return $this->render('Admin/admin_graphisme/carte_visite/carte_visite_finale/new.html.twig', [
            'carte_visite_finale' => $carteVisiteFinale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_visite_finale_show", methods={"GET"})
     */
    public function show(CarteVisiteFinale $carteVisiteFinale): Response
    {
        return $this->render('Admin/admin_graphisme/carte_visite/carte_visite_finale/show.html.twig', [
            'carte_visite_finale' => $carteVisiteFinale,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carte_visite_finale_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CarteVisiteFinale $carteVisiteFinale): Response
    {
        $form = $this->createForm(CarteVisiteFinaleType::class, $carteVisiteFinale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carte_visite_finale_index');
        }

        return $this->render('Admin/admin_graphisme/carte_visite/carte_visite_finale/edit.html.twig', [
            'carte_visite_finale' => $carteVisiteFinale,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_visite_finale_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CarteVisiteFinale $carteVisiteFinale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carteVisiteFinale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carteVisiteFinale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carte_visite_finale_index');
    }
}
