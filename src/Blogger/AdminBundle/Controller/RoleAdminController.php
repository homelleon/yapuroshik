<?php

namespace Blogger\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Blogger\UserBundle\Entity\Role;
use Blogger\UserBundle\Form\Role\RoleType;

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
        $form = $this->createForm(RoleType::class, $role);
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
     * @Route("/admin/role/{name}", name="role")
     */
    public function showRoleAction($name) {
        $role = $this->getDoctrine()
            ->getRepository('UserBundle:Role')
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
            ->getRepository('UserBundle:Role')
            ->findAll();
        
        return $this->render('AdminBundle:Role:roles.html.twig', [
            'roles' => $roles
        ]);
    }
}
