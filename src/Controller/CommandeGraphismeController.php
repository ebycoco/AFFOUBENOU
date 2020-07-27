<?php

namespace App\Controller;

use App\Entity\ServicesGraphisme;
use App\Entity\CommandeLogo;
use App\Form\CommandeLogoType; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommandeGraphismeController extends AbstractController
{
    /**
     * @Route("/commande/graphisme/{id}", name="commande_graphisme", methods={"GET","POST"})
     */
    public function logo(ServicesGraphisme $servicesGraphisme,Request $request)
    {
         
        
        if ($servicesGraphisme->getCategorie()->getNom()=='Conception de logo') {
            $commandeLogo = new CommandeLogo();
            $form = $this->createForm(CommandeLogoType::class, $commandeLogo);
            $form->handleRequest($request); 

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $commandeLogo->setUser($this->getUser());
                $commandeLogo->setServicesGraphisme($servicesGraphisme);
                $entityManager->persist($commandeLogo);
                $entityManager->flush();
    
                return $this->redirectToRoute('profile_commande');
            }
            return $this->render('service_graphisme/commande_graphisme.html.twig', [
                'services' => $servicesGraphisme,
                'commande_logo' => $commandeLogo,
                'form' => $form->createView(),
            ]);
        }elseif ($servicesGraphisme->getCategorie()->getNom()=='Conception de logo') {
            $commandeLogo = new CommandeLogo();
            $form = $this->createForm(CommandeLogoType::class, $commandeLogo);
            $form->handleRequest($request); 

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $commandeLogo->setUser($this->getUser());
                $commandeLogo->setServicesGraphisme($servicesGraphisme);
                $entityManager->persist($commandeLogo);
                $entityManager->flush();
    
                return $this->redirectToRoute('profile_commande');
            }
            return $this->render('service_graphisme/commande_graphisme.html.twig', [
                'services' => $servicesGraphisme,
                'commande_logo' => $commandeLogo,
                'form' => $form->createView(),
            ]);
        }
         else {
            return $this->redirectToRoute('service_graphisme');
        }
        
        
       
    }
}
