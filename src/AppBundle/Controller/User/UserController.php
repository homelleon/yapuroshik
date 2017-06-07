<?php

namespace AppBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User\User;
use AppBundle\Entity\User\UserAccount;
use AppBundle\Form\User\UserAccountType;
use AppBundle\Entity\File\Avatar;

/**
 * Users account controller.
 */
class UserController extends Controller {

    /**
     * Renders page with user and user account data.
     * 
     * @Route("/user/{username}", name="user")
     * @param string username
     */
    public function userAction($username) {
        $doctrine = $this->getDoctrine();
        $user = $doctrine->getRepository(User::class)
            ->findOneBy([
                'username' => $username
                    ]);
        return $this->render(':User:user.html.twig', [
            'user' => $user
        ]);
    }  
    
    /**
     * Renders user account edit form page.<br>On submit redirect to user page.
     * 
     * @Route("/user/{username}/account/edit", name="account_edit")
     * @param string username
     * @param Request $request
     */
    public function editAccountAction($username, Request $request) {
        $doctrine = $this->getDoctrine();
        $user = $doctrine->getRepository(User::class)
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
            
            $manager = $doctrine->getManager();
            
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

                
                $manager->persist($avatar);
            }
            
            $userAccount->setAvatar($avatar);            
            $user->setUserAccount($userAccount);            
            
            $manager->persist($user);
            $manager->persist($userAccount);
            $manager->flush();
            
            return $this->redirectToRoute('user',[
                'username' => $username
            ]);
        }
        return $this->render(':User:account_create.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
    

}
