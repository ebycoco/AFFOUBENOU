<?php

namespace App\Controller\Profil;

use App\Entity\CommandeServicesWeb;
use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use App\Repository\CommandeLogoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommandeLogoPersonaliseRepository;
use App\Repository\CommandeServicesWebRepository;
use App\Repository\ServiceWebDemoRepository;
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
     * @Route("/commande/graphisme", name="commande", methods={"GET"})
     */
    public function commandeGrap(CommandeLogoRepository $commandeLogoRepository,CommandeLogoPersonaliseRepository $commandeLogoPersonaliseRepository): Response
    {
        
        return $this->render('profil/commande.html.twig',[
            'commande_logos' => $commandeLogoRepository->findByLastCommand($this->getUser()),
            'commande_logo_personalises' => $commandeLogoPersonaliseRepository->findByLastCommandperso($this->getUser()),
        ]);
    } 

     /**
     * @Route("/commande/web", name="commande_web", methods={"GET"})
     */
    public function commandeWeb(CommandeServicesWebRepository $commandeServicesWebRepository): Response
    {
        
        return $this->render('profil/commandeweb.html.twig',[
            'commande_webs' => $commandeServicesWebRepository->findByLastCommandweb($this->getUser()),
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


    /**
     * @Route("/voir/{id}", name="voir_site", methods={"GET"})
     */
    public function viewsite(CommandeServicesWeb $commandeServicesWeb): Response
    { 
        
       
        if ($commandeServicesWeb->getUser()->getPrenom() == $this->getUser()->getPrenom()) {

            if ($commandeServicesWeb->getCategorieWeb()->getNom() == 'Blog') {
                return $this->render('Users/templates/blog/index.html.twig',[
                'commande_services_web' => $commandeServicesWeb,
            ]);
            }elseif ($commandeServicesWeb->getCategorieWeb()->getNom() =='E-commerce') { 
                return $this->render('Users/templates/ecommerce/index.html.twig',[
                    'commande_services_web' => $commandeServicesWeb,
                    ]);
            }else {
                return $this->redirectToRoute('profile_commande_services_web_index');
            }
            if ($commandeServicesWeb->getCategorieWeb()->getNom() == 'Ecommerce') {
                return $this->render('Users/templates/blog/index.html.twig',[
                'commande_services_web' => $commandeServicesWeb,
            ]);
            }
            
        } else{
            return $this->redirectToRoute('profile_commande_services_web_index');
        } 
        
    }
}
