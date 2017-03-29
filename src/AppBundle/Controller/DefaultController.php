<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Article;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="show_main")
     * @Method("GET")
     */
    public function mainAction()
    {
         $articles = $this->getDoctrine()
        ->getRepository('AppBundle:Article')
        ->findAll();
         
         $pages = array();
         for($i=0;$i<count($articles);$i++)
        {
            $pages[] = $i+1;
        }        
        return $this->render('main/index.html.twig', [
            'articles' => $articles,
            'pages' => $pages           
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
        return $this->render('nonews/index.html.twig');
        
    }
    
    /**
     * @Route("/addArticle/{name}/{author}/{theme}/{image_id}/{description}")
     * 
     * @param type $name
     * @param type $author
     * @param type $theme
     * @param type $image_id
     * @param type $description
     * @return \AppBundle\Controller\Response
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
        ->getRepository('AppBundle:Article')
        ->findOneByName($name);
        
        $em = $this->getDoctrine()->getManager();
        
        $em->remove($article);
        
        $em->flush();
        
        return new Response('Deleted article with name '.$article->getName());
    }

    /**
     * @Route("/news/{id}")
     * 
     * @param type $id
     * @return type
     * @throws type
     */
    public function  showNewsAction($id)
    {
        $article = $this->getDoctrine()
        ->getRepository('AppBundle:Article')
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
