<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller\Article;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Blogger\BlogBundle\Entity\Article;
use Blogger\FileBundle\Entity\Image;
use Blogger\BlogBundle\Form\Article\ArticleType;
use Blogger\BlogBundle\Form\Article\EditArticleType;

class ArticleController extends Controller {
    
    /**
     * @Route("/news/create", name="article_create");
     *      
     * @param type 
     * @return type
     * @throws type
     */
    public function articleCreateAction(Request $request) {
        
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
                      
            $article = $form->getData();  
            $created = new DateTime();
            $author = "homelleon";
            
            $path = "121";
            $path = "/image/" . $path;            
            $image = new Image($path);
            $image->setFormat("JPG");
            $image->setHeight(800);
            $image->setWidth(600);
            $image->setName("Image2");
            
            $article->setAuthor($author);
            $article->setImage($image);
            $article->setCreated($created);
            $article->setUpdated($created); 
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->persist($article);            
            $em->flush();
            
            return $this->redirectToRoute('show_main');
        }
            
        return $this->render('BlogBundle:Page:newscreate.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }   
    
    /**
     * @Route("/news/edit/{id}", name="news_edit");
     * 
     * @param type $id
     * @return type
     * @throws type
     */
    public function articleEditAction($id, Request $request) {
        $article = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->find($id);
        
        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id ' . $id
            );
        }        
        
        $form = $this->createForm(EditArticleType::class, $article); ;        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $article->setUpdated(new DateTime());
            $article->setIsUpdated(true);
            $em = $this->getDoctrine()->getManager();          
            $em->persist($article);
            $em->flush();
            
            return $this->redirectToRoute('show_main');
        }
            
        return $this->render('BlogBundle:Page:newsedit.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }    
       
    

    /**
     * @Route("/news/delete/{title}")
     * 
     * @param type $title
     * @return type
     * @throws type
     */
    public function articleRemoveAction($title) {
        $article = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findOneBy(array('title' => $title));

        $em = $this->getDoctrine()->getManager();

        $em->remove($article);

        $em->flush();

        return new Response('Deleted article with title ' . $article->getTitle());
    }
    
}
