<?php

namespace Blogger\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    /**
     * @Route("/user/{username}", name="user")
     */
    public function userAction($username) {
        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findOneBy([
                'username' => $username
                    ]);
        return $this->render('UserBundle:User:user.html.twig', [
            'user' => $user
        ]);
    }  

}
