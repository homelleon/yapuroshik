<?php

namespace AppBundle\Controller\Article;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use AppBundle\Entity\Blog\Article;
use AppBundle\Form\Blog\Article\ArticleType;
use AppBundle\Form\Blog\Article\EditArticleType;

/**
 * Articles and news controller.
 */
class ArticleController extends Controller {
    
    /**
     * Renders page with article with setted id parameter.
     * 
     * @Route("/news/{id}", requirements={"id" = "\d+"}, name="show_news")
     * 
     * @param integer $id
     * @return string html.twig page
     */
    public function showAction($id) {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id ' . $id
            );
        }

        return $this->render(':Blog\News:news.html.twig', [
                'article' => $article
        ]);
    }
    
    /**
     * Renders form page to create new article.<br>After submit redirects to 
     * main page.
     * 
     * @Route("/news/create", name="article_create");
     *      
     * @param Request $request 
     * @return string html.twig page
     */
    public function createAction(Request $request) {
        
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
                      
            $article = $form->getData(); 
            $created = new DateTime();
            $author = $this->getUser();
            
            $file = $article->getImage();
            $fileConfigurator = $this->get('file_configurator');            
            $image = $fileConfigurator->getImage(
                    $file,
                    $this->getParameter('image_directory')
            );
                                                
            $article->setAuthor($author);
            $article->setImage($image);
            $article->setCreated($created);
            $article->setUpdated($created); 
            
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($image);
            $manager->persist($article);            
            $manager->flush();
            
            return $this->redirectToRoute('main');
        }
            
        return $this->render(':Blog\News:news_create.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }   
    
    /**
     * Renders form page to edit existed article.<br>After submit redirects to
     * main page.
     * 
     * @Route("/news/edit/{id}", name="news_edit");
     * 
     * @param integer $id
     * @return string html.twig page
     * @throws type
     */
    public function editAction($id, Request $request) {
        $doctrine = $this->getDoctrine();
        
        $article = $doctrine
            ->getRepository(Article::class)
            ->find($id);
        
        if($this->getUser() != $article->getAuthor()) {
            throw $this->createAccessDeniedException('You are not permitted to edit this article!');
        }
        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id ' . $id
            );
        }        
        
        $image = $article->getImage();
        $form = $this->createForm(EditArticleType::class, $article); ;        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            
            $article->setUpdated(new DateTime());
            $article->setIsUpdated(true);            
            
            $manager = $doctrine->getManager();            
            
            $file = $article->getImage();
            
            if($file != NULL) {                
                $fileConfigurator = $this->get('file_configurator');
                $image = $fileConfigurator->getImage(
                    $file,
                    $this->getParameter('image_directory')
                );             
                
                $manager->persist($image);
            } 
            
            $article->setImage($image);
                                 
            $manager->persist($article);            
            $manager->flush();
            
            return $this->redirectToRoute('main');
        }
            
        return $this->render(':Blog\News:news_edit.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }      
    
}