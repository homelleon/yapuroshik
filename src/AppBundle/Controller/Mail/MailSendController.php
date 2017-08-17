<?php

namespace AppBundle\Controller\Mail;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User\User;

/**
 * Admin page controller.
 */
class MailSendController extends Controller {

    /**
     * Sends registration greetings information for user by e-mail.
     * 
     * @Route("/mail/{name}", name="mail")
     * 
     * @param string name
     * @return type
     */
    public function sendGreetingsAction(string $name) {
        $user = $this->getDoctrine()->getRepository(User::class)
            ->findOneBy(['username' => $name]);
        if($user == null) {
            throw $this->createNotFoundException(
                'There is no user with name: ' . $name
            );
        }
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('admin@yapuroshik.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    'Mail/mail_registration.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
        ;
    
        $this->get('mailer')->send($message);
        
        return $this->render('Mail/mail_registration.html.twig',
            [
                'name' => $name
            ]);     
    }

}
