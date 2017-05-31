<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace AppBundle\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ContactsRedirectController extends Controller {

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
    
    public function getArticleCount() {
        return $this->article_count;
    }

}
