<?php

namespace Blogger\FileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ImageController extends Controller
{
    /**
     * @Route("/image/{id}")
     */
    public function imageAction($id)
    {
        
        return $this->render('FileBundle:Default:index.html.twig');
    }
}
