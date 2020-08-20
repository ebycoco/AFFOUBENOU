<?php

namespace App\Controller\Profil\Graphisme\CarteVisite;

use App\Entity\CarteVisite;
use App\Entity\CarteVisiteFiligramme;
use App\Form\CarteVisiteFiligrammeType;
use App\Repository\CarteVisiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use App\Repository\CarteVisiteFiligrammeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/profile/carte-visite/filigramme", name="profile_")
 */
class CarteVisiteFiligrammeController extends AbstractController
{
    /**
     * @Route("/index", name="carte_visite_filigramme_index", methods={"GET"})
     */
    public function index(CarteVisiteFiligrammeRepository $carteVisiteFiligrammeRepository): Response
    {
        return $this->render('Admin/admin_graphisme/carte_visite/carte_visite_filigramme/index.html.twig', [
            'carte_visite_filigrammes' => $carteVisiteFiligrammeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="carte_visite_filigramme_new", methods={"GET","POST"})
     */
    public function new(Request $request,CarteVisite $carteVisite): Response
    {
        $carteVisiteFiligramme = new CarteVisiteFiligramme();
        $form = $this->createForm(CarteVisiteFiligrammeType::class, $carteVisiteFiligramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $carteVisiteFiligramme->setUser($this->getUser());
            $carteVisiteFiligramme->setCartevisite($carteVisite);
            $carteVisite->setEtat('niveau 2');
            $entityManager->persist($carteVisiteFiligramme);
            $entityManager->flush();

            return $this->redirectToRoute('admin_carte_visite_index');
        }

        return $this->render('Admin/admin_graphisme/carte_visite/carte_visite_filigramme/new.html.twig', [
            'carte_visite_filigramme' => $carteVisiteFiligramme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/voir/{id}", name="carte_show", methods={"GET"})
     */
    public function show(CarteVisite $CarteVisite): Response
    {
        return $this->render('profil/graphisme/carte_visite/filigrame_carte_visite.html.twig', [
            'CarteVisite' => $CarteVisite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carte_visite_filigramme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CarteVisiteFiligramme $carteVisiteFiligramme): Response
    {
        $form = $this->createForm(CarteVisiteFiligrammeType::class, $carteVisiteFiligramme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carte_visite_filigramme_index');
        }

        return $this->render('Admin/admin_graphisme/carte_visite/carte_visite_filigramme/edit.html.twig', [
            'carte_visite_filigramme' => $carteVisiteFiligramme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_visite_filigramme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CarteVisiteFiligramme $carteVisiteFiligramme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carteVisiteFiligramme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carteVisiteFiligramme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carte_visite_filigramme_index');
    }
}
