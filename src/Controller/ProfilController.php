<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *  @Route("/profile", name="profile_")
 */
class ProfilController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        
        return $this->render('profil/index.html.twig');
    }

    /**
     * @Route("/commande", name="commande")
     */
    public function commande()
    {
        
        return $this->render('profil/commande.html.twig');
    }

    /**
     * @Route("/miseajour/{id}", name="mise_a_jour", methods={"GET","POST"})
     */
    public function edit(Request $request, Users $users): Response
    {
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
