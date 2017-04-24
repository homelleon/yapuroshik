<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Blogger\BlogBundle\Entity\Article;

class ArticleController extends Controller {

   
    /**
     * @Route("/addArticle/{title}/{author}/{theme}/{image}/{description}")
     * 
     * @param type $title
     * @param type $author
     * @param type $theme
     * @param type $image
     * @param type $description
     * @return \BlogBundle\Controller\Response
     */
    public function createArticleAction($title, $author, $theme, $image, $description) {
        $article = new Article();
        $article->setTitle($title);
        $article->setAuthor($author);
        $article->setTheme($theme);
        $article->setImage($image);
        $article->setDescription($description);
        $created = new DateTime();
        $article->setCreated($created);
        $article->setUpdated($created);

        $em = $this->getDoctrine()->getManager();

        $em->persist($article);

        $em->flush();

        return new Response('Saved new article with id ' . $article->getId());
    }
    
       
    /**
     * @Route("/news/edit/{id}", name="news_edit");
     * 
     * @param type $id
     * @return type
     * @throws type
     */
    public function newsEditAction($id, Request $request) {
        $article = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->find($id);
        
        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id ' . $id
            );
        }        
        
        $form = $this->createEditForm($article);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $article->setUpdated(new DateTime());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            
            return $this->redirectToRoute('show_main');
        }
            
        return $this->render('BlogBundle:Page:newsedit.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);
    }

    /**
     * @Route("/deleteArticle/{name}")
     * 
     * @param type $name
     * @return type
     * @throws type
     */
    public function deleteArticleAction($name) {
        $article = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findOneByName($name);

        $em = $this->getDoctrine()->getManager();

        $em->remove($article);

        $em->flush();

        return new Response('Deleted article with name ' . $article->getName());
    }

    private function createEditForm($article) {        
        $form = $this->createFormBuilder($article)
            ->add('title',TextType::class, [
                'label' => 'Название: '
            ])
            ->add('theme',TextType::class, [
                'label' => 'Тема: '
            ])
            ->add('description',TextType::class, [
                'label' => 'Описание: '
            ])
            ->add('is_deleted',CheckboxType::class, [
                'label' => 'Удалить',
                'required' => false
            ])  
            ->add('submit',SubmitType::class, [
                'label' => 'Применить'
            ])             
            ->getForm();
        return $form;        
    }

}
