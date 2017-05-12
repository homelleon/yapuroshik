<?php

namespace Blogger\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    /**
     * @Route("/user/{name}")
     */
    public function userAction($name) {
        return $this->render('UserBundle:Default:index.html.twig', [
                    'name' => $name
        ]);
    }    

}
