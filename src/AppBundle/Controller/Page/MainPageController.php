<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace AppBundle\Controller\Page;

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
     * @Route("/", name="main")
     * @Method("GET")
     */
    public function mainAction() {
        $a_p_count = $this->getArticlePageCount();
        $articles = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->findAll(); 
        $a_count = count($articles);
        $articles = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
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
        
        return $this->render('AppBundle:Blog:Page:index.html.twig', [
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
            ->getRepository('AppBundle:Blog:Article')
            ->findAll(); 
        $a_count = count($articles);
        $pages_count = ($a_count - 1)/$a_p_count + 1;
        
        if($pages_count != 1) {
            for($i = 1;$i<=$pages_count;$i++){
                $pages[] = $i;
            }
            $offset = $page*$a_p_count - $a_p_count;
            $articles = $this->getDoctrine()
            ->getRepository('Blog:Article')
            ->findBy(
                array(),
                array('created' => 'DESC'),
                $a_p_count,
                $offset                   
            );
        } else {
            $pages[] = 1;
        }
        
        return $this->render('AppBundle:Page:index.html.twig', [
            'articles' => $articles,
            'pages' => $pages
        ]);
    }
    
    /**
     * @Route("/sort/news/{category}/{value}", name="news_sorted")
     * @param type $theme
     */
    public function sortAction($category, $value) {
        $dorctrine = $this->getDoctrine();
        $a_p_count = $this->getArticlePageCount();
        
        if($category == 'author') {
            $user = $dorctrine
                ->getRepository('AppBundle:User:User')
                ->findOneBy([
                    'username' => $value
                ]);
            $newValue = $user;
        } else {
            $newValue = $value;
        }
        
        $articles = $dorctrine
            ->getRepository('AppBundle:Blog:Article')
            ->findBy(
                array($category => $newValue),
                array('created' => 'DESC')                
            );
        $a_count = count($articles);
        $pages_count = ($a_count - 1)/$a_p_count + 1;       
        if($pages_count != 1) {
            for($i = 1;$i<=$pages_count;$i++){
                $pages[] = $i;
            }
            $offset = $pages_count*$a_p_count - $a_p_count;
            
            if($offset <0) {
                $offset = 0;
                $pages = 1;
            }
            $artciles = $dorctrine
                ->getRepository('AppBundle:Blog:Article')
                ->findBy(
                    array($category => $newValue),
                    array('created' => 'DESC'),
                    $a_p_count,
                    $offset
                );
        } else {
            $pages[] = 1;
        }
        $categoryRus = $this->getSortCategory($category);        
        return $this->render('AppBundle:News:news_sorted.html.twig', [            
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
