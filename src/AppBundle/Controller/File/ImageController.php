<?php

namespace AppBundle\Controller\File;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ImageController extends Controller
{
    /**
     * @Route("/image/{id}")
     */
    public function imageAction($id)
    {
        $doctrine = $this->getDoctrine();
        $image = $doctrine
            ->getRepository('FileBundle:Image')
            ->find($id);
        
        return $this->render('FileBundle:Image:index.html.twig',[
            'image' => $image
        ]);
    }
    
}
