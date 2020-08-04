<?php

namespace App\Controller\Profil\Graphisme\CarteVisite;

use App\Entity\CarteVisite;
use App\Form\CarteVisiteType;
use App\Repository\CarteVisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile/carte/visite", name="profile_")
 */
class CarteVisiteController extends AbstractController
{
    /**
     * @Route("/", name="carte_visite_index", methods={"GET"})
     */
    public function index(CarteVisiteRepository $carteVisiteRepository): Response
    {
        return $this->render('profil/graphisme/carte_visite/index.html.twig', [
            'carte_visites' => $carteVisiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="carte_visite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carteVisite = new CarteVisite();
        $form = $this->createForm(CarteVisiteType::class, $carteVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $carteVisite->setUser($this->getUser());
            $carteVisite->setEtat('niveau 1');
            $carteVisite->setPrix('2000');
            $entityManager->persist($carteVisite);
            $entityManager->flush();

            return $this->redirectToRoute('profile_commande');
        }

        return $this->render('profil/graphisme/carte_visite/new.html.twig', [
            'carte_visite' => $carteVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_visite_show", methods={"GET"})
     */
    public function show(CarteVisite $carteVisite): Response
    {
        return $this->render('profil/graphisme/carte_visite/show.html.twig', [
            'carte_visite' => $carteVisite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carte_visite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CarteVisite $carteVisite): Response
    {
        $form = $this->createForm(CarteVisiteType::class, $carteVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile_carte_visite_index');
        }

        return $this->render('profil/graphisme/carte_visite/edit.html.twig', [
            'carte_visite' => $carteVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_visite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CarteVisite $carteVisite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carteVisite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carteVisite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profile_carte_visite_index');
    }
}
