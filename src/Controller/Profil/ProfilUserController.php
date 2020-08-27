<?php

namespace App\Controller\Profil;

use App\Entity\Categorie;
use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\CategorieRepository;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ServicesGraphismeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *  @Route("/profile", name="profile_")
 */
class ProfilUserController extends AbstractController
{
    /**
     * @Route("/accueil", name="profile")
     */
    public function index()
    {

        if ($this->getUser()->getAdresse() == null) {
            $this->addFlash('warning', 'Veuillez mettre votre profile pour faire les achats');
            return $this->render('profil/index.html.twig');
        } else {
            return $this->render('profil/index.html.twig');
        }
    }
    /**
     * Elle permet defaire la mise à jour dans la partie profile
     * @Route("/miseajour/{id}", name="mise_a_jour", methods={"GET","POST"})
     */
    public function edit(Request $request, Users $users): Response
    {
        if ($this->getUser()->getAdresse() == null) {
            $this->addFlash('warning', 'Veuillez mettre votre profile SVP !');
        }
        $form = $this->createForm(UsersType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Votre compte à été mise a jour avec success');
            return $this->redirectToRoute('profile_index');
        }

        return $this->render('profil/edit.html.twig', [
            'users' => $users,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Elle permet de lister les services graphisme dans la partie profile
     * @Route("/graphisme", name="service_graphisme")
     */
    public function graphisme(CategorieRepository $categorieRepository)
    {
        return $this->render('profil/graphisme/graphisme.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/graphisme/choix/logo/{id}", name="service_graphisme_choix")
     */
    public function choix(ServicesGraphismeRepository $servicesLogoRepository, Categorie $categorie)
    {

        return $this->render('profil/graphisme/logo/choix_logo.html.twig', [
            'categorie' => $categorie,
            'serviceLogos' => $servicesLogoRepository->findByGraph($categorie),
        ]);
    }

    /**
     * @Route("/graphisme/logo/{id}", name="service_graphisme_logo")
     */
    public function logo(ServicesGraphismeRepository $servicesLogoRepository, Categorie $categorie)
    {

        return $this->render('profil/graphisme/logo/services_logo.html.twig', [
            'categorie' => $categorie,
            'serviceLogos' => $servicesLogoRepository->findByGraph($categorie),
        ]);
    }
}
