<?php

namespace App\Controller\Profil\Webservice;

use App\Entity\CategorieWeb;
use App\Entity\AutreFonctionnalite;
use App\Entity\CommandeServicesWeb;
use App\Entity\ServiceWeb;
use App\Entity\ServiceWebDemo;
use App\Form\CommandeServicesWebType;
use App\Repository\CategorieWebRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommandeServicesWebRepository;
use App\Repository\ServiceWebDemoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/profile/services-web",name="profile_")
 */
class CommandeServicesWebController extends AbstractController
{
    /**
     * @Route("/", name="commande_services_web_index", methods={"GET"})
     */
    public function index(CommandeServicesWebRepository $commandeServicesWebRepository,CategorieWebRepository $categorieWebRepository): Response
    {
        return $this->render('profil/web/commande_services_web/index.html.twig', [
            'commande_services_webs' => $commandeServicesWebRepository->findAll(),
            'categorie_webs' => $categorieWebRepository->findAll(),
        ]);
    }
    /* en dessous ces pour web */

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
     * @Route("/new/{id}", name="commande_services_web_new", methods={"GET","POST"})
     */
    public function new(Request $request,CategorieWeb $categorieWeb): Response
    {
        $commandeServicesWeb = new CommandeServicesWeb();
        $form = $this->createForm(CommandeServicesWebType::class, $commandeServicesWeb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commandeServicesWeb->setUser($this->getUser());
            $commandeServicesWeb-> setCategorieWeb($categorieWeb); 
            $commandeServicesWeb->setLien('inactive');
            $entityManager->persist($commandeServicesWeb);
            $entityManager->flush();

            return $this->redirectToRoute('profile_commande_web');
        }

        return $this->render('profil/web/commande_services_web/new.html.twig', [
            'commande_services_web' => $commandeServicesWeb,
            'categorieWeb' => $categorieWeb, 
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_services_web_show", methods={"GET"})
     */
    public function show(CommandeServicesWeb $commandeServicesWeb,ServiceWebDemoRepository $serviceWebDemoRepository): Response
    {
        return $this->render('profil/web/commande_services_web/show.html.twig', [
            'commande_services_web' => $commandeServicesWeb,
            'serviceWeb'=>$serviceWebDemoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande_services_web_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CommandeServicesWeb $commandeServicesWeb): Response
    {
        $form = $this->createForm(CommandeServicesWebType::class, $commandeServicesWeb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile_commande_services_web_index');
        }

        return $this->render('profil/web/commande_services_web/edit.html.twig', [
            'commande_services_web' => $commandeServicesWeb,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_services_web_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommandeServicesWeb $commandeServicesWeb): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeServicesWeb->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandeServicesWeb);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profile_commande_services_web_index');
    }
}
