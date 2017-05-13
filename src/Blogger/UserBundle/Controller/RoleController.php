<?php

namespace Blogger\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\UserBundle\Form\Role\RoleType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Description of RoleController
 * 
 * @author homelleon
 *
 */
class RoleController extends Controller {
    
    /**
     * @Route("/admin/roles/{id}", name="role")
     * @param type $name
     */
    public function showAction($id) {
        
        $role = $this->getDoctrine()
            ->getRepository('UserBundle:Role')
            ->find($id);

        if (!$role) {
            throw $this->createNotFoundException(
                'No article found for id ' . $id
            );
        }
        
        return $this->render('AdminBundle:Admin:roles.html.twig', [
            'role' => $role
        ]);
    }
    
    /**
     * @Route("admin/roles", name="admin_roles")
     * @return type
     */
    public function showAllAction() {
        $roles = $this->getDoctrine()
            ->getRepository('UserBundle:Role')
            ->findAll();
        
        return $this->render('AdminBundle:Admin:roles.html.twig', [
            'roles' => $roles
        ]);
    }

    /**
     * @Route("/admin/roles/create", name="roles_create")
     * @param $request
     * @return type
     */
    public function createAction(Request $request) {
        
        $role = new Role();       
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
                      
            $role = $form->getData(); 
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($role);            
            $em->flush();
            
            return $this->redirectToRoute('admin');
        }
            
        return $this->render('AdminBundle:Admin:roles_create.html.twig', [
            'form' => $form->createView(),
            'article' => $article
        ]);        
    }
    
}
