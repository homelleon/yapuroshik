<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Blog\Article;

/**
 * Admin page controller.
 */
class PageAdminController extends Controller {

    /**
     * Renders admin main page.
     * 
     * @Route("/admin", name="admin")
     */
    public function indexAction() {
        return $this->render(':Security\Admin:index.html.twig');
    }

    /**
     * Renders artcile list page for admins.
     * 
     * @Route("/admin/articles", name="admin_articles")
     * @return type
     */
    public function articlesAction() {
        $articles = $this->getDoctrine()
                ->getRepository(Article::class)
                ->findAll();
        return $this->render(':Security\Admin:articles.html.twig', [
                    'articles' => $articles
        ]);
    }

    /**
     * Deletes article from data base with setted id parameter.
     * 
     * @Route("/news/delete/{id}", name="article_delete")
     * 
     * @param integer $id Article's id.
     * @return article list html.twig page.
     */
    public function deleteAction($id) {
        $article = $this->getDoctrine()
                ->getRepository(Article::class)
                ->find($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($article);
        $manager->flush();

        return $this->redirectToRoute('admin_articles');
    }

}
