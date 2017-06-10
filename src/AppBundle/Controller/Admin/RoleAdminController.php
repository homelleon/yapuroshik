<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User\Role;
use AppBundle\Form\Role\RoleCreateType;

/**
 * Role controller for admin page.
 *
 * @author homelleon
 */
class RoleAdminController extends Controller {

    /**
     * Renders page with form to create new role.
     * 
     * @Route("/admin/roles/create", name="roles_create")
     */
    public function createAction(Request $request) {
        $role = new Role();
        $form = $this->createForm(RoleCreateType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $role = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($role);
            $manager->flush();

            return $this->redirectToRoute('roles');
        }

        return $this->render(':Security\Role:roles_create.html.twig', [
                    'form' => $form->createView(),
                    'role' => $role
        ]);
    }

    /**
     * Deletes role with setted id parameter and redirects to role list page. 
     * 
     * @Route("/admin/roles/delete/{id}", name="role_delete")
     * @param integer $id Role's id
     */
    public function deleteAction($id) {
        $doctrine = $this->getDoctrine();
        $role = $doctrine
                ->getRepository(Role::class)
                ->find($id);

        $manager = $doctrine->getManager();
        $manager->remove($role);
        $manager->flush();

        return $this->redirectToRoute('roles');
    }

    /**
     * Renders page with role description with setted name parameter.
     * 
     * @Route("/admin/role/{name}", name="role")
     */
    public function showAction($name) {
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
     * Renders page with list of roles.
     * 
     * @Route("admin/roles", name="roles")
     * @return type
     */
    public function showListAction() {
        $roles = $this->getDoctrine()
                ->getRepository(Role::class)
                ->findAll();

        return $this->render(':Security\Role:roles.html.twig', [
                    'roles' => $roles
        ]);
    }

}
