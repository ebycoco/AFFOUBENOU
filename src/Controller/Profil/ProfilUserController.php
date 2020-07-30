<?php

namespace App\Controller\Profil;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use App\Repository\CommandeLogoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *  @Route("/profile", name="profile_")
 */
class ProfilUserController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        
        if ($this->getUser()->getAdresse()== null) {
            $this->addFlash('warning', 'Veuillez mettre votre profile pour faire les achats'); 
        }
        return $this->render('profil/index.html.twig');
    }

    /**
     * @Route("/commande", name="commande", methods={"GET"})
     */
    public function commande(CommandeLogoRepository $commandeLogoRepository): Response
    {
        
        return $this->render('profil/commande.html.twig',[
            'commande_logos' => $commandeLogoRepository->findByLastCommand($this->getUser()),
        ]);
    }

    /**
     * @Route("/miseajour/{id}", name="mise_a_jour", methods={"GET","POST"})
     */
    public function edit(Request $request, Users $users): Response
    {
        if ($this->getUser()->getAdresse()== null) {
            $this->addFlash('warning', 'Veuillez mettre votre profile SVP !'); 
        }
        $form = $this->createForm(UsersType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile_index');
        }

        return $this->render('profil/edit.html.twig', [
            'users' => $users,
            'form' => $form->createView(),
        ]);
    }
}
