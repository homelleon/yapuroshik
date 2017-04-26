<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class NewsController extends Controller {

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
}
