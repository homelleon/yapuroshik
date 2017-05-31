<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User\Role;
use AppBundle\Form\Role\RoleCreateType;

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
            
        return $this->render(':Security\Role:roles_create.html.twig', [
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
            ->getRepository(Role::class)
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
            ->getRepository(Role::class)
            ->findOneBy([
                'name' => $name
            ]);  
            
        return $this->render(':Security\Role:role.html.twig', [
            'role' => $role
        ]);
    }
 
    
    /**
     * @Route("admin/roles", name="roles")
     * @return type
     */
    public function showAllAction() {
        $roles = $this->getDoctrine()
            ->getRepository(Role::class)
            ->findAll();
        
        return $this->render(':Security\Role:roles.html.twig', [
            'roles' => $roles
        ]);
    }
}
