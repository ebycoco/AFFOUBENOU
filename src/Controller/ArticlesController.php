<?php

namespace App\Controller;

use App\Entity\Articles; 
use App\Entity\Commentaires;
use App\Form\CommentairesType;
use App\Form\CommentairesIconnuType;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommentairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="app_articles_index", methods={"GET"})
     */
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
            'populaires' => $articlesRepository->findByPopulaireRecent('1')
        ]);
    }
    
    /**
     * @Route("/article/{slug}", name="app_articles_inconnu", methods={"GET","POST"})
     */
    public function inconnu(Articles $article,ArticlesRepository $articlesRepository,Request $request,CommentairesRepository $commentairesRepository): Response
    {
        $commentaire = new Commentaires();
        $form = $this->createForm(CommentairesIconnuType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commentaire->setUser($this->getUser());
            $commentaire->setArticle($article);
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_articles_index');
        }
        return $this->render('articles/show.html.twig', [
            'article' => $article, 
            'form' => $form->createView(),
            'populaires' => $articlesRepository->findByPopulaireRecent('1'),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")  
     * @Route("/articles/article/{slug}", name="app_articles_show", methods={"GET","POST"})
     */
    public function show(Articles $article,ArticlesRepository $articlesRepository,Request $request,CommentairesRepository $commentairesRepository): Response
    {
        $commentaire = new Commentaires();
        $form = $this->createForm(CommentairesType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commentaire->setUser($this->getUser());
            $commentaire->setArticle($article);
            $entityManager->persist($commentaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_articles_index');
        }
        return $this->render('articles/show.html.twig', [
            'article' => $article, 
            'form' => $form->createView(),
            'populaires' => $articlesRepository->findByPopulaireRecent('1'),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")    
     * @Route("/favoris/ajout/{id}", name="app_ajout_favoris")
     */
    public function ajoutFavoris(Articles $article ): Response
    {  

        if (!$article) { 
            throw new NotFoundHttpException('pas d\'article trouvée');
        }
        $article->addFavori($this->getUser());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($article);
        $entityManager->flush();
        return $this->redirectToRoute('app_articles_index');
    }
    /**
     * @IsGranted("ROLE_USER")    
     * @Route("/favoris/retrait/{id}", name="app_retrait_favoris")
     */
    public function retraitFavoris(Articles $article ): Response
    {  

        if (!$article) { 
            throw new NotFoundHttpException('pas d\'article trouvée');
        }
        $article->RemoveFavori($this->getUser());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($article);
        $entityManager->flush();
        return $this->redirectToRoute('app_articles_index');
    }
  
}
