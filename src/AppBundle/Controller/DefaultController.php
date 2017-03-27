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
            'notes' => ['Главная','Тут полная информация о моем канале','Также '
                . 'есть много всего нужного и не нужного','Помимо этого много'
                . 'фото и видео','А также рекомендации школ','В заключении хочу'
                . 'сказать, что мечтаю подружиться с вами','Сайт рыбатекст 
                    поможет дизайнеру, верстальщику, вебмастеру сгенерировать 
                    несколько абзацев более менее осмысленного текста рыбы на
                    русском языке, а начинающему оратору отточить навык публичных 
                    выступлений в домашних условиях. При создании генератора мы 
                    использовали небезизвестный универсальный код речей. Текст 
                    генерируется абзацами случайным образом от двух до десяти 
                    предложений в абзаце, что позволяет сделать текст более 
                    привлекательным и живым для визуально-слухового восприятия.
                    По своей сути рыбатекст является альтернативой традиционному 
                    lorem ipsum, который вызывает у некторых людей недоумение 
                    при попытках прочитать рыбу текст. В отличии от lorem ipsum,
                    текст рыба на русском языке наполнит любой макет непонятным
                    смыслом и придаст неповторимый колорит советских времен. ']
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
