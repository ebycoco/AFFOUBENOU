<?php

namespace App\Controller;

use App\Entity\CommandeLogo;
use App\Entity\CommandePredefine;
use App\Form\CommandeLogoType;
use App\Repository\CommandeFinaleRepository;
use App\Repository\CommandeLogoRepository;
use App\Repository\CommandePredefineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
class CommandeLogoController extends AbstractController
{
    

    /**
     * @Route("/new", name="commande_logo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commandeLogo = new CommandeLogo();
        $form = $this->createForm(CommandeLogoType::class, $commandeLogo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commandeLogo);
            $entityManager->flush();

            return $this->redirectToRoute('commande_logo_index');
        }

        return $this->render('commande_logo/new.html.twig', [
            'commande_logo' => $commandeLogo,
            'form' => $form->createView(),
        ]);
    } 


    /**
     * @Route("/{id}", name="commande_logo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommandeLogo $commandeLogo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeLogo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandeLogo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_logo_index');
    }
}
