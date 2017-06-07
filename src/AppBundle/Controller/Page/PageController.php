<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace AppBundle\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Controller for base pages.
 */
class PageController extends Controller {
    
    
    /**
     * Renders "about" page.
     * 
     * @Route("/about", name="about")
     * @Method("GET")
     */
    public function aboutAction() {
        return $this->render(':Blog\Page:about.html.twig');
    }

    /**
     * Renders "photo" page.
     * 
     * @Route("/photo", name="photo")
     * @Method("GET")
     */
    public function photoAction() {
        return $this->render(':Blog\Page:nonews.html.twig');
    }

    /**
     * Renders "video" page.
     * 
     * @Route("/video", name="video")
     * @Method("GET")
     */
    public function videoAction() {
        return $this->render(':Blog\Page:nonews.html.twig');
    }

    /**
     * Renders "contacts" page.
     * 
     * @Route("/contacts", name="contacts")
     * @Method("GET")
     */
    public function contactsAction() {
        return $this->render(':Blog\Page:contacts.html.twig');
    }

}
