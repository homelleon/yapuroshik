<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Blogger\UserBundle\Entity\User;

class AdminPageController extends Controller {

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
       $users = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findAll();
       return $this->render('AdminBundle:Admin:users.html.twig', [
           'users' => $users
       ]); 
    }    

}
