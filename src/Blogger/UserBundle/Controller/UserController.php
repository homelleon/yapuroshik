<?php

namespace Blogger\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    /**
     * @Route("/user/{id}", name="user")
     */
    public function userAction($id) {
        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findById($id);
        return $this->render('UserBundle:Default:index.html.twig', [
            'user' => $user
        ]);
    }  

}
