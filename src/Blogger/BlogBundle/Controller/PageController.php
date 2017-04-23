<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PageController extends Controller {

    /**
     * @Route("/", name="show_main")
     * @Method("GET")
     */
    public function mainAction() {
        $articles = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findAll();

        return $this->render('BlogBundle:Page:index.html.twig', [
            'articles' => $articles
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
                'No product found for id ' . $id
            );
        }

        return $this->render('BlogBundle:Page:news.html.twig', [
                'article' => $article
        ]);
    }

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
        $article->setName($title);
        $article->setAuthor($author);
        $article->setTheme($theme);
        $article->setImage($image);
        $article->setDescription($description);

        $em = $this->getDoctrine()->getManager();

        $em->persist($article);

        $em->flush();

        return new Response('Saved new article with id ' . $article->getId());
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

}
