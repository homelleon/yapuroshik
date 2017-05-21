<?php

namespace Blogger\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller {

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request) {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('UserBundle:Security:login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    } 
    
    /**
     * @Route("/registration", name="registration")
     */
    public function registrationAction(Request $request) {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {                      
            $user = $form->getData();             
            $role = $this->getDoctrine()
                ->getRepository('UserBundle:Role')
                ->findOneBy([
                    'name' => 'user'
                ]);
            
            $salt = "a";
            $user->setSalt($salt);
            $user->setRole($role); 
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user); 
            $em->flush();
            
            return $this->redirectToRoute('main');
        }
            
        return $this->render('AdminBundle:User:users_create.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

}
