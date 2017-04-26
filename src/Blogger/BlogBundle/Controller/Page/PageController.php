<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PageController extends Controller {
    
    
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

}
