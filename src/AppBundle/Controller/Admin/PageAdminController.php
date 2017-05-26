<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PageAdminController extends Controller {

    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction() {
        return $this->render('Admin:index.html.twig');
    }
    
    /**
     * @Route("/admin/articles", name="admin_articles")
     * @return type
     */
    public function articlesAction() {
        $articles = $this->getDoctrine()
            ->getRepository('Blog:Article')
            ->findAll();
       return $this->render('Admin:Admin:articles.html.twig', [
           'articles' => $articles
       ]); 
    }
    
    

    /**
     * @Route("/news/delete/{id}", name="article_delete")
     * 
     * @param type $id
     * @return type
     * @throws type
     */
    public function deleteAction($id) {
        $article = $this->getDoctrine()
            ->getRepository('Blog:Article')
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('admin_articles');
    }

}
