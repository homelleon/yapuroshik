<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PageController extends Controller {
    
    private $article_count = 5;

    /**
     * @Route("/", name="show_main")
     * @Method("GET")
     */
    public function mainAction() {
        $a_count = $this->getArticleCount();
        $articles = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findBy(  
                array(),
                array('created' => 'DESC'),
                $a_count,
                0
             ); 
        
        $pages_count = count($articles)/$a_count; 
        for($i = 1;$i<=$pages_count+1;$i++){
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
        if($page = 1) {
            return $this->redirect("show_main");
        }
        $a_count = $this->getArticleCount();
        $pages_count = count($articles)/$a_count; 
        for($i = 1;$i<=$pages_count+1;$i++){
            $pages[] = $i;
        }
        
        if($page == 1) {
            return $this->redirect('/');
        }
        
        $offset = $page*$a_count - $a_count;
        $articles = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findBy(
                array(),
                array('created' => 'DESC'),
                $a_count,
                $offset                   
            );
        
        return $this->render('BlogBundle:Page:page.html.twig', [
            'articles' => $articles,
            'pages' => $pages
        ]);
    }

    /**
     * @Route("/about", name="show_about")
     * @Method("GET")
     */
    public function aboutAction() {
        return $this->render('BlogBundle:Page:about.html.twig');
    }

    /**
     * @Route("/photo", name="show_photo")
     * @Method("GET")
     */
    public function photoAction() {
        return $this->render('BlogBundle:Page:nonews.html.twig');
    }

    /**
     * @Route("/video", name="show_video")
     * @Method("GET")
     */
    public function videoAction() {
        return $this->render('BlogBundle:Page:nonews.html.twig');
    }

    /**
     * @Route("/contacts", name="show_contacts")
     * @Method("GET")
     */
    public function contactsAction() {
        return $this->render('BlogBundle:Page:contacts.html.twig');
    }

    /**
     * @Route("/news/{id}", requirements={"id" = "\d+"}, name="show_news")
     * 
     * @param type $id
     * @return type
     * @throws type
     */
    public function newsAction($id) {
        $article = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id ' . $id
            );
        }

        return $this->render('BlogBundle:Page:news.html.twig', [
                'article' => $article
        ]);
    }

    /**
     * @Route("/goToVkontakte", name="vk")
     * @return type
     */
    public function vkAction() {
        return $this->redirect("https://vk.com/yaproshik");
    }
    
      /**
     * @Route("goToFacebook", name="fb")
     * @return type
     */
    public function facebookAction() {
        return $this->redirect("https://www.facebook.com/yaproshik/");
    } 
    
    public function getArticleCount() {
        return $this->article_count;
    }

}
