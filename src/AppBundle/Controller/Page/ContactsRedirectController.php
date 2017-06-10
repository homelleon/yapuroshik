<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace AppBundle\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Controller that redirect user to web pages shown at the contacts page.
 */
class ContactsRedirectController extends Controller {

    /**
     * Redirects to vkontake web page.
     * 
     * @Route("/goToVkontakte", name="vk")
     * @return type
     */
    public function vkAction() {
        return $this->redirect("https://vk.com/yaproshik");
    }

    /**
     * Redirects to facebook web page.
     * 
     * @Route("goToFacebook", name="fb")
     * @return type
     */
    public function facebookAction() {
        return $this->redirect("https://www.facebook.com/yaproshik/");
    }

}
