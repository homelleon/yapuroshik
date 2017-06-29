<?php

namespace AppBundle\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User\User;
use AppBundle\Entity\User\Role;
use AppBundle\Form\User\UserType;

/**
 * Securtiy contoller for authorisation.
 */
class SecurityController extends Controller {

    /**
     * Renders login-in page form.
     * 
     * @Route("/login", name="login")
     */
    public function loginAction() {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(':Security:login.html.twig', [
                    'last_username' => $lastUsername,
                    'error' => $error,
        ]);
    }

    /**
     * Renders registration form page.<br>On submit redirects to the main page.
     * 
     * @Route("/registration", name="registration")
     */
    public function registrationAction(Request $request) {
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

            $salt = "a";
            $user->setSalt($salt);
            $user->setRole($role);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('main');
        }

        return $this->render(':Security:registration.html.twig', [
                    'form' => $form->createView(),
                    'user' => $user
        ]);
    }

}
