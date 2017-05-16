<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller {

    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction() {
        return $this->render('AdminBundle:Admin:index.html.twig');
    }
    
    /**
     * @Route("/admin/articles", name="admin_articles")
     * @return type
     */
    public function articlesAction() {
        $articles = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findAll();
       return $this->render('AdminBundle:Admin:articles.html.twig', [
           'articles' => $articles
       ]); 
    }
    
     /**
     * @Route("/admin/users", name="admin_users")
     * @return type
     */
    public function usersAction() {
       return $this->render('AdminBundle:Admin:index.html.twig'); 
    }

}
