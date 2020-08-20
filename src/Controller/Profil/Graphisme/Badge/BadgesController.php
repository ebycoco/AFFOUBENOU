<?php

namespace App\Controller\Profil\Graphisme\Badge;

use App\Entity\Badges;
use App\Form\BadgesType;
use App\Repository\BadgesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile/badges", name="profile_")
 */
class BadgesController extends AbstractController
{
    /**
     * @Route("/", name="badges_index", methods={"GET"})
     */
    public function index(BadgesRepository $badgesRepository): Response
    {
        return $this->render('profil/graphisme/badges/index.html.twig', [
            'badges' => $badgesRepository->findAll(),
        ]);
    }

    /* Debut les affiche de la partie profile */

    /**
     * Elle permet de lister les affiche simple dans la partie commande du profile
     *  
     * @Route(" /commande", name="commande_badge", methods={"GET"})
     */
    public function commandeaffiche(BadgesRepository $badgesRepository, PaginatorInterface $paginator,Request $request): Response
    {
        $badges = $paginator->paginate(
            $badgesRepository->findAllVisibleQuery($this->getUser()),
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        return $this->render('profil/commandebadge.html.twig',[ 
            'badges' => $badges,
        ]);
    } 

    /**
     * @Route("/new", name="badges_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $badge = new Badges();
        $form = $this->createForm(BadgesType::class, $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $badge->setUser($this->getUser());
            $badge->setEtat('niveau 1');
            $badge->setPrix('5000');
            $entityManager->persist($badge);
            $entityManager->flush();
            $this->addFlash('success', 'Votre achat à été effectuer avec success');
            return $this->redirectToRoute('profile_commande');
        }

        return $this->render('profil/graphisme/badges/new.html.twig', [
            'badge' => $badge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badges_show", methods={"GET"})
     */
    public function show(Badges $badge): Response
    {
        return $this->render('profil/graphisme/badges/show.html.twig', [
            'badge' => $badge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="badges_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Badges $badge): Response
    {
        $form = $this->createForm(BadgesType::class, $badge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile_commande');
        }

        return $this->render('profil/graphisme/badges/edit.html.twig', [
            'badge' => $badge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="badges_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Badges $badge): Response
    {
        if ($this->isCsrfTokenValid('delete'.$badge->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($badge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profile_commande');
    }
}
