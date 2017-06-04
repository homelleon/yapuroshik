<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace AppBundle\Controller\Comment;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use AppBundle\Entity\Blog\Article;
use AppBundle\Entity\Blog\Comment;
use AppBundle\Form\Blog\Comment\CommentType;

/**
 * Comments controller.
 */
class CommentController extends Controller {
    
    /**
     * Renders form page to create a new comment. 
     * 
     * @Route("/news/{id}/comment/add", name="comment_add")
     * 
     * @param integer $id
     * @param Request $request
     * @return html.twig page
     * @throws type
     */
    public function createAction($id, Request $request) {        
        $doctrine = $this->getDoctrine();
        $article = $doctrine
            ->getRepository(Article::class)
            ->find($id);
        
        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id ' . $id
            );
        }
        
        $comment = new Comment();
        
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $created = new DateTime();
            $author = $this->getUser();

            $comment->setAuthor($author);
            $comment->setCreated($created);
            $article->addComment($comment);          
            
            $manager = $doctrine->getManager();
            $manager->persist($comment);
            $manager->persist($article);            
            $manager->flush();
            
            return $this->redirectToRoute('show_news',[
                'id' => $id
            ]);
        }
        
        return $this->render(':Blog\News:comment_add.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }
    
}
