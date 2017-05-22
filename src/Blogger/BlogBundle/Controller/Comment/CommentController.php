<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller\Comment;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Blogger\BlogBundle\Entity\Article;
use Blogger\UserBundle\Entity\User;
use Blogger\BlogBundle\Entity\Comment;
use Blogger\BlogBundle\Form\Comment\CommentType;

class CommentController extends Controller {
    
    /**
     * @Route("/news/{id}/comment/add", name="comment_add")
     * @param type $id
     * @param Request $request
     * @return type
     * @throws type
     */
    public function createCommentAction($id, Request $request) {
        $doctrine = $this->getDoctrine();
        $article = $doctrine
            ->getRepository('BlogBundle:Article')
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
            $username = 'homelleon';
            $author = $doctrine
                ->getRepository('UserBundle:User')
                ->findOneBy([
                    'username' => $username
                ]);
            $comment->setAuthor($author);
            $comment->setCreated($created);
            $article->addComment($comment);          
            
            $em = $doctrine->getManager();
            $em->persist($comment);
            $em->persist($article);            
            $em->flush();
            
            return $this->redirectToRoute('show_news',[
                'id' => $id
            ]);
        }
        
        return $this->render('BlogBundle:News:comment_add.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }
    
}
