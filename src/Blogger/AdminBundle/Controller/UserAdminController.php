<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Blogger\UserBundle\Entity\User;
use Blogger\UserBundle\Form\User\UserType;

/**
 * Description of UserAdminController
 *
 * @author homelleon
 */
class UserAdminController extends Controller  {
    
     /**
     * @Route("/admin/users/create", name="admin_users_create")
     */
    public function createUserAction(Request $request) {
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
            
            return $this->redirectToRoute('admin_users');
        }
            
        return $this->render('AdminBundle:Admin:users_create.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
    
    /**
     * @Route("/admin/users/delete/{username}", name="admin_users_delete")
     */
    public function deleteUserAction($username) {
        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findOneBy(array('username' => $username));

        $em = $this->getDoctrine()->getManager();

        $em->remove($user);

        $em->flush();

        return new Response('Deleted user with name ' . $user->getUsername());
    }
}
