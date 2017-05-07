<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class MainPageController extends Controller {
    
    private $article_page_count = 5;
    
    /**
     * @Route("/test")     
     */
    public function testAction() {
        return $this->render('test.html.twig');
    }

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
        if($pages_count <= 1) {
            $pages[] = 0;
        } else {
            for($i = 1;$i<=$pages_count;$i++){
                $pages[] = $i;
            }
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
        $articles = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findAll(); 
        $a_count = count($articles);
        $pages_count = ($a_count - 1)/$a_p_count + 1;
        
        if($pages_count != 1) {
            for($i = 1;$i<=$pages_count;$i++){
                $pages[] = $i;
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
        } else {
            $pages[] = 1;
        }
        
        return $this->render('BlogBundle:Page:index.html.twig', [
            'articles' => $articles,
            'pages' => $pages
        ]);
    }
    
    /**
     * @Route("/sort/news/{category}/{value}", name="news_sorted")
     * @param type $theme
     */
    public function sortAction($category, $value) {
        
        $a_p_count = $this->getArticlePageCount();
        $articles = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findBy(
                array($category => $value),
                array('created' => 'DESC')                
            );
        $a_count = count($articles);
        $pages_count = ($a_count - 1)/$a_p_count + 1;       
        if($pages_count != 1) {
            for($i = 1;$i<=$pages_count;$i++){
                $pages[] = $i;
            }
            $offset = $pages_count*$a_p_count - $a_p_count;            
            $artciles = $this->getDoctrine()
                ->getRepository('BlogBundle:Article')
                ->findBy(
                    array($category => $value),
                    array('created' => 'DESC'),
                    $a_p_count,
                    $offset
                );
        } else {
            $pages[] = 1;
        }
        $categoryRus = $this->getSortCategory($category);        
        return $this->render('BlogBundle:News:news_sorted.html.twig', [            
            'articles' => $articles,
            'pages' => $pages,
            'category' => $categoryRus,
            'value' => $value
        ]);
    }


    private function getArticlePageCount() {
        return $this->article_page_count;
    }
    
    private function getSortCategory($category) {
        switch ($category) {
            case 'theme':
                $category = 'теме';
                break;
            case 'title':
                $category = 'названию';
                break;
            case 'author':
                $category = 'автору';
                break;
        }
        return $category;
    }
}
