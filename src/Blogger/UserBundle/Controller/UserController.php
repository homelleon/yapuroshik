<?php

namespace Blogger\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Blogger\UserBundle\Entity\User;
use Blogger\UserBundle\Entity\UserAccount;
use Blogger\UserBundle\Form\User\UserType;
use Blogger\UserBundle\Form\User\UserAccountType;
use Blogger\FileBundle\Entity\Avatar;

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
        if(!$this->isGranted('ROLE_MODERATOR')) {
            if(($this->getUser() != $user)) {
                throw $this->createAccessDeniedException('You have no permission to edit other user profile!');
            }
        }
        $userAccount = $user->getUserAccount();
        if(!$userAccount) {
            $userAccount = new UserAccount();
        }
        
        $avatar = $userAccount->getAvatar();
        $form = $this->createForm(UserAccountType::class, $userAccount);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $userAccount = $form->getData();
            
            $em = $doctrine->getManager();
            
            $file = $userAccount->getAvatar();
            if($file != NULL) {
                
                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move(
                    $this->getParameter('user_directory'),
                    $fileName
                );

                $height = 800;
                $width = 600;
                $format = 'JPG';

                $avatar = new Avatar($fileName);
                $avatar->setName($fileName);
                $avatar->setFormat($format);
                $avatar->setHeight($height);
                $avatar->setWidth($width);

                
                $em->persist($avatar);
            }
            
            $userAccount->setAvatar($avatar);            
            $user->setUserAccount($userAccount);            
            
            $em->persist($user);
            $em->persist($userAccount);
            $em->flush();
            
            return $this->redirectToRoute('user',[
                'username' => $username
            ]);
        }
        return $this->render('UserBundle:User:account_create.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
    

}
