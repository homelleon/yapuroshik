<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Blogger\UserBundle\Entity\Role;
use Blogger\UserBundle\Form\Role\RoleCreateType;

/**
 * Description of RoleAdminController
 *
 * @author homelleon
 */
class RoleAdminController extends Controller  {
    
     /**
     * @Route("/admin/roles/create", name="roles_create")
     */
    public function createRoleAction(Request $request) {
        $role = new Role();
        $form = $this->createForm(RoleCreateType::class, $role);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
                      
            $role = $form->getData();                 
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($role);           
            $em->flush();
            
            return $this->redirectToRoute('roles');
        }
            
        return $this->render('AdminBundle:Role:roles_create.html.twig', [
            'form' => $form->createView(),
            'role' => $role
        ]);
    }
    
    /**
     * @Route("/admin/roles/delete/{id}", name="role_delete")
     * @param type $id
     */
    public function removeRoleAction($id) {
        $doctrine = $this->getDoctrine();
        $role = $doctrine
            ->getRepository('User:Role')
            ->find($id);
        
        $em = $doctrine->getManager();
        $em->remove($role);
        $em->flush();

        return $this->redirectToRoute('roles');        
        
    }


    /**
     * @Route("/admin/role/{name}", name="role")
     */
    public function showRoleAction($name) {
        $role = $this->getDoctrine()
            ->getRepository('User:Role')
            ->findOneBy([
                'name' => $name
            ]);  
            
        return $this->render('AdminBundle:Role:role.html.twig', [
            'role' => $role
        ]);
    }
 
    
    /**
     * @Route("admin/roles", name="roles")
     * @return type
     */
    public function showAllAction() {
        $roles = $this->getDoctrine()
            ->getRepository('User:Role')
            ->findAll();
        
        return $this->render('AdminBundle:Role:roles.html.twig', [
            'roles' => $roles
        ]);
    }
}
