<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class MainPageController extends Controller {
    
    private $article_page_count = 5;

    /**
     * @Route("/", name="show_main")
     * @Method("GET")
     */
    public function mainAction() {
        $a_p_count = $this->getArticlePageCount();
        $articles = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findAll(); 
        $a_count = count($articles);
        $articles = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findBy(  
                array(),
                array('created' => 'DESC'),
                $a_p_count,
                0
             ); 
        
        $pages_count = ($a_count - 1)/$a_p_count + 1; 
        for($i = 1;$i<=$pages_count;$i++){
            $pages[] = $i;
        }
        
        return $this->render('BlogBundle:Page:index.html.twig', [
            'articles' => $articles,
            'pages' => $pages
        ]);
    }
    
    /**
     * @Route("/page/{page}", name="show_page")
     */
    public function pageAction($page) {
       
        $a_p_count = $this->getArticlePageCount();
        $pages_count = count($articles)/$a_p_count; 
        for($i = 1;$i<=$pages_count;$i++){
            $pages[] = $i;
        }
        
        if($page == 1) {
            return $this->render('BlogBundle:Page:index.html.twig', [
                'articles' => $articles,
                'pages' => $pages
            ]);
        }
        
        $offset = $page*$a_p_count - $a_p_count;
        $articles = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findBy(
                array(),
                array('created' => 'DESC'),
                $a_p_count,
                $offset                   
            );
        
        return $this->render('BlogBundle:Page:page.html.twig', [
            'articles' => $articles,
            'pages' => $pages
        ]);
    }
    
    private function getArticlePageCount() {
        return $this->article_page_count;
    }

}
