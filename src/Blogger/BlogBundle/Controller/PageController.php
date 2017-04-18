<?php
// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PageController extends Controller
{
   /**
     * @Route("/", name="show_main")
     * @Method("GET")
     */
    public function mainAction()
    {
         $articles = $this->getDoctrine()
        ->getRepository('BlogBundle:Article')
        ->findAll();
               
        return $this->render('main/index.html.twig', [
            'articles' => $articles          
        ]);
    }
    
    /**
     * @Route("/about", name="show_about")
     * @Method("GET")
     */
    public function aboutAction()
    {
        return $this->render('nonews/about/about.html.twig');
        
    }
    
       /**
     * @Route("/photo", name="show_photo")
     * @Method("GET")
     */
    public function photoAction()
    {
        return $this->render('nonews/index.html.twig');
        
    }
    
       /**
     * @Route("/video", name="show_video")
     * @Method("GET")
     */
    public function videoAction()
    {
        return $this->render('nonews/index.html.twig');
        
    }
    
     /**
     * @Route("/contacts", name="show_contacts")
     * @Method("GET")
     */
    public function contactsAction()
    {
        return $this->render('nonews/contacts/contacts.html.twig');
        
    }
    
    /**
     * @Route("/addArticle/{name}/{author}/{theme}/{image_id}/{description}")
     * 
     * @param type $name
     * @param type $author
     * @param type $theme
     * @param type $image_id
     * @param type $description
     * @return \BlogBundle\Controller\Response
     */
    public function createArticleAction($name, $author, $theme, $image_id, $description)
    {
        $article = new Article();
        $article->setName($name);
        $article->setAuthor($author);
        $article->setTheme($theme);
        $article->setImageId($image_id);
        $article->setDescription($description);
        
        $em = $this->getDoctrine()->getManager();
        
        $em->persist($article);
        
        $em->flush();   
        
        return new Response('Saved new article with id '.$article->getId());
    }
    
    /**
     * @Route("/deleteArticle/{name}")
     * 
     * @param type $name
     * @return type
     * @throws type
     */    
    public function deleteArticleAction($name)
    {   
        $article = $this->getDoctrine()
        ->getRepository('BlogBundle:Article')
        ->findOneByName($name);
        
        $em = $this->getDoctrine()->getManager();
        
        $em->remove($article);
        
        $em->flush();
        
        return new Response('Deleted article with name '.$article->getName());
    }

    /**
     * @Route("/news/{id}", name="show_news")
     * 
     * @param type $id
     * @return type
     * @throws type
     */
    public function  showNewsAction($id)
    {
        $article = $this->getDoctrine()
        ->getRepository('BlogBundle:Article')
        ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        
        return $this->render('news/index.html.twig', [            
            'article' => $article
        ]);
    }
}