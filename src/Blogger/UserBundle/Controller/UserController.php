<?php

namespace Blogger\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Blogger\UserBundle\Entity\User;
use Blogger\UserBundle\Entity\UserAccount;
use Blogger\UserBundle\Form\User\UserType;
use Blogger\UserBundle\Form\User\UserAccountType;

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
    
    /**
     * @Route("/user/{username}/account/edit", name="account_edit")
     * @param Request $request
     */
    public function editAccountAction($username, Request $request) {
        $doctrine = $this->getDoctrine();
        $user = $doctrine
                ->getRepository('UserBundle:User')
                ->findOneBy([
                    'username' => $username
                ]);
        $userAccount = $user->getUserAccount();
        if(!$userAccount) {
            $userAccount = new UserAccount();
        }
        $form = $this->createForm(UserAccountType::class, $userAccount);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $userAccount = $form->getData();
            $user->setUserAccount($userAccount);
            
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->persist($userAccount);
            $em->flush();
            
            return $this->redirectToRoute('main');
        }
        return $this->render('UserBundle:User:account_create.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
    

}
