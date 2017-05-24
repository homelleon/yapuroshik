<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller\Article;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Blogger\BlogBundle\Entity\Article;
use Blogger\FileBundle\Entity\Image;
use Blogger\BlogBundle\Form\Article\ArticleType;
use Blogger\BlogBundle\Form\Article\EditArticleType;

class ArticleController extends Controller {
    
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

        return $this->render('BlogBundle:News:news.html.twig', [
                'article' => $article
        ]);
    }
    
    /**
     * @Route("/news/create", name="article_create");
     *      
     * @param type 
     * @return type
     * @throws type
     */
    public function createAction(Request $request) {
        
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
                      
            $article = $form->getData(); 
            $created = new DateTime();
            $author = $this->getUser();
            
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $article->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('image_directory'),
                $fileName
            );
            
            $height = 800;
            $width = 600;
            $format = 'JPG';
                 
            $image = new Image($fileName);
            $image->setName($fileName);
            $image->setFormat($format);
            $image->setHeight($height);
            $image->setWidth($width);
                                                
            $article->setAuthor($author);
            $article->setImage($image);
            $article->setCreated($created);
            $article->setUpdated($created); 
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->persist($article);            
            $em->flush();
            
            return $this->redirectToRoute('main');
        }
            
        return $this->render('BlogBundle:News:news_create.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }   
    
    /**
     * @Route("/news/edit/{id}", name="news_edit");
     * 
     * @param type $id
     * @return type
     * @throws type
     */
    public function editAction($id, Request $request) {
        $doctrine = $this->getDoctrine();
        
        $article = $doctrine
            ->getRepository('BlogBundle:Article')
            ->find($id);
        
        if($this->getUser() != $article->getAuthor()) {
            throw $this->createAccessDeniedException('You are not permitted to edit this article!');
        }
        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id ' . $id
            );
        }        
        
        $image = $article->getImage();
        $form = $this->createForm(EditArticleType::class, $article); ;        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            
            $article->setUpdated(new DateTime());
            $article->setIsUpdated(true);            
            
            $em = $doctrine->getManager(); 
            
            if($article->getImage() != NULL) {
                $file = $article->getImage();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move(
                    $this->getParameter('image_directory'),
                    $fileName
                );

                $height = 800;
                $width = 600;
                $format = 'JPG';

                $image = new Image($fileName);
                $image->setName($fileName);
                $image->setFormat($format);
                $image->setHeight($height);
                $image->setWidth($width);                
                
                $em->persist($image);
            } 
            
            $article->setImage($image);
                                 
            $em->persist($article);
            
            $em->flush();
            
            return $this->redirectToRoute('main');
        }
            
        return $this->render('BlogBundle:News:news_edit.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }    
       
    

    /**
     * @Route("/news/delete/{title}")
     * 
     * @param type $title
     * @return type
     * @throws type
     */
    public function removeAction($title) {
        $article = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findOneBy(array('title' => $title));

        $em = $this->getDoctrine()->getManager();

        $em->remove($article);

        $em->flush();

        return new Response('Deleted article with title ' . $article->getTitle());
    }
    
    
}
