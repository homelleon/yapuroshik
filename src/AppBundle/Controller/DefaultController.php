<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="show_main")
     * @Method("GET")
     */
    public function mainAction()
    {
        return $this->render('main/index.html.twig', [
            'notes' => ['Главная']
        ]);
    }
    
    /**
     * @Route("/about", name="show_about")
     * @Method("GET")
     */
    public function aboutAction()
    {
        $notes = ['Обо мне'];
        return $this->render('main/index.html.twig', [
            'notes' => $notes
        ]);
        
    }
    
       /**
     * @Route("/photo", name="show_photo")
     * @Method("GET")
     */
    public function photoAction()
    {
        $notes = ['Фото'];
        return $this->render('main/index.html.twig', [
            'notes' => $notes
        ]);
        
    }
    
       /**
     * @Route("/video", name="show_video")
     * @Method("GET")
     */
    public function videoAction()
    {
        $notes = ['Видео'];
        return $this->render('main/index.html.twig', [
            'notes' => $notes
        ]);
        
    }
    
       /**
     * @Route("/contacts", name="show_contacts")
     * @Method("GET")
     */
    public function contactsAction()
    {
        $notes = ['Контакты'];
        return $this->render('main/index.html.twig', [
            'notes' => $notes
        ]);
        
    }
    
    
}
