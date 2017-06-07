<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User\User;
use AppBundle\Entity\User\Role;
use AppBundle\Form\User\UserType;

/**
 * User contoller for admin page.
 *
 * @author homelleon
 */
class UserAdminController extends Controller  {
    
        
    /**
     * Renders page with users' list.
     * 
     * @Route("/admin/users", name="admin_users")
     * @return twig.html page
     */
    public function showListAction() {
       $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
       return $this->render(':Security\User:users.html.twig', [
           'users' => $users
       ]); 
    }   
    
    /**
     * Renders page with form to create new user. <br>Redirects to users' list
     * page.
     * 
     * @Route("/admin/users/create", name="admin_users_create")
     */
    public function createAction(Request $request) {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
                      
            $user = $form->getData();             
            $role = $this->getDoctrine()
                ->getRepository(Role::class)
                ->findOneBy([
                    'name' => 'user'
                    ]);            
            
            //$user->setSalt($salt);
            $user->setRole($role);           
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);       
            $entityManager->flush();
            
            return $this->redirectToRoute('admin_users');
        }
            
        return $this->render(':Security\User:users_create.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
    
    /**
     * Deletes user from data base. Redirects to users' list page.
     * <p>NOTE: Use it cearfully! Can't turn user back after deleting.
     * 
     * @Route("/admin/users/delete/{id}", name="admin_users_delete")
     */
    public function deleteAction($id) {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find(id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('admin_users');
    }
}
