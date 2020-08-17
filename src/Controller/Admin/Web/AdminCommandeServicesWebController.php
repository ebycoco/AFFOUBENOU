<?php

namespace App\Controller\Admin\Web;

use App\Entity\CategorieWeb;
use App\Entity\AutreFonctionnalite;
use App\Entity\CommandeServicesWeb;
use App\Form\CommandeServicesWebType;
use App\Repository\CategorieWebRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommandeServicesWebRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/commande/services/web",name="admin_")
 */
class AdminCommandeServicesWebController extends AbstractController
{
    /**
     * @Route("/", name="services_web_index", methods={"GET"})
     */
    public function index(CommandeServicesWebRepository $commandeServicesWebRepository): Response
    {
        return $this->render('Admin/admin_siteWeb/commande_services_web/index.html.twig', [
            'commande_services_webs' => $commandeServicesWebRepository->findByLastCommanddepot('active'),
        ]);
    }

    /**
     * @Route("/{id}", name="services_web_show", methods={"GET"})
     */
    public function show(CommandeServicesWeb $commandeServicesWeb): Response
    {
        return $this->render('Admin/admin_siteWeb/commande_services_web/show.html.twig', [
            'commande_services_web' => $commandeServicesWeb,
        ]);
    }

    /**
     * @Route("/{id}", name="services_web_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CommandeServicesWeb $commandeServicesWeb): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeServicesWeb->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandeServicesWeb);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_commande_services_web_index');
    }
}
