<?php

namespace AppBundle\Controller\Admin;

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
     * @Route("/admin/users", name="admin_users")
     * @return type
     */
    public function usersAction() {
       $users = $this->getDoctrine()
            ->getRepository('BlogBundle:User:User')
            ->findAll();
       return $this->render('AdminBundle:User:users.html.twig', [
           'users' => $users
       ]); 
    }   
    
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
                ->getRepository('BlogBundle:User:Role')
                ->findOneBy([
                    'name' => 'user'
                    ]);            
            
            $user->setSalt($salt);
            $user->setRole($role);           
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);       
            $em->flush();
            
            return $this->redirectToRoute('admin_users');
        }
            
        return $this->render('AdminBundle:User:users_create.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
    
    /**
     * @Route("/admin/users/delete/{id}", name="admin_users_delete")
     */
    public function deleteUserAction($id) {
        $user = $this->getDoctrine()
            ->getRepository('BlogBundle:User:User')
            ->find(id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('admin_users');
    }
}
